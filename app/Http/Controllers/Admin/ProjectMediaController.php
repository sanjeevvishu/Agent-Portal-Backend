<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectMediaController extends Controller
{

    public function getImage(Request $request, ProjectMedia $media)
    {
        return response()->make(
            Storage::disk('s3')->get($media->local_path),
            200,
            ['Content-Type' => 'image/jpeg']
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request, Project $project)
    {
        //return $pm = ProjectMedia::where('project_id', $project->id)->latest()->first();
        // dd($pm, $pm->media_s3_path,Storage::disk('s3')->url($pm->local_path));
        $searchData = [];
        $projectMediasQuery = ProjectMedia::where('project_id', $project->id);
        if ($request->filled('key') && $request->filled('value')) {
            $searchData     = $request->all();
            $searchText     = $request->value;
            $searchColumn   = $request->key;
            $projectMediasQuery->where($searchColumn, 'like', '%' . $searchText . '%');
        }  
        $projectMediasQuery->latest('id');

        $projectMedias = $projectMediasQuery->paginate(15);
        $projectMedias->appends($searchData);
        
        return view('admin.projectMedia.index', compact('projectMedias', 'project', 'searchData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        return view('admin.projectMedia.create',compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Project $project, Request $request)
    {
        $user = $request->user();
        //return $request->all();
        if(!$project)
        return response()->json('Project not found.', 404);

        $validation = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'asset_type'     => 'required|string|max:190',
            'file'           => 'image|max:8192',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors()->first(), 422);
        }
        
        if ($request->hasfile('file')) {

            $projectMediaType = $request->input('asset_type');

            $folderName     = $project->id;
            $image           = $request->file('file');
            $fileSize       = $image->getSize();
            $fileName        = $image->getClientOriginalName();
            $fileMimeType    = $image->getMimeType();
            $filePath = 'project_media/' . $folderName . '/' . $projectMediaType . '/' . $fileName;
            
            Storage::disk('s3') ->put($filePath, $image->get());

            $inputs = [
                "project_id"        => $project->id,
                'file_name'         => $fileName,
                'asset_type'        => $projectMediaType,
                "local_path"        => $filePath,
               // "s3_path"           => env('CLOUDFRONT_URL') . '/' . $filePath,
                "file_mime_type"    => $fileMimeType,
                "file_size"         => $fileSize,
                "category"          => $request->category ? strtolower($request->category) : null,
                "created_user_id"   => $user->id,
                "created_at"        => \Carbon\Carbon::now()->format("Y-m-d H:i:s"),
                "updated_at"        => \Carbon\Carbon::now()->format("Y-m-d H:i:s")
            ];

            $projectMedia = new ProjectMedia();
            $projectMedia->fill($inputs);
            $projectMedia->save();

            return response()->json(['status' => true, 'message' => 'project media uploded successfully.'], 200);
        }
        return response()->json('Oops! Something missing.', 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectMedia  $projectMedia
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectMedia $projectMedia)
    {
        return view('admin.projectMedia.show', compact('projectMedia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectMedia  $projectMedia
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectMedia $projectMedia)
    {
        return view('admin.projectMedia.edit', compact('projectMedia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectMedia  $projectMedia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectMedia $medium)
    {
        $inputs = $request->all();
        $medium->fill($inputs);
        $medium->save();

        return redirect(route('admin.projects.media.index',$medium->project_id))->with('flash_success', 'Project media updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectMedia  $projectMedia
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectMedia $medium)
    {
       
        Storage::delete($medium->local_path);
        if(Storage::disk('s3')->exists($medium->local_path)){
            $message = ('Media deleted.');
            Storage::disk('s3')->delete($medium->local_path);
        }else{
            $message = ('Media File does not exists.');
        }
        $medium->delete();

        return redirect(route('admin.projects.media.index',$medium->project_id))->with('flash_success', 'Project media deleted successfully.');
    }

    public function list(Request $request, Project $project)
    {
        $validation = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'asset_type'  => 'required|string|max:190',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status'    => false,
                'message'   => 'Validation errors',
                'errors'    => $validation->errors()->first(),
            ],422);
        }

        $projectMedias = ProjectMedia::where('project_id', $project->id)->where('asset_type', $request->asset_type)->latest()->get();
        return response()->json([
            'status'    => true,
            'data'      => $projectMedias
        ],200);
    }

    public function delete(Project $project, ProjectMedia $projectMedia)
    {
    
        if(!$projectMedia){
            return response()->json([
                'status'    => false,
                'message'   => 'Media not found.',
                'data'      => $projectMedia
            ],422);
        }


        if(Storage::disk('s3')->exists($projectMedia->local_path)){
            $message = ('Media deleted.');
            Storage::disk('s3')->delete($projectMedia->local_path);
        }else{
            $message = ('Media File does not exists.');
        }
        $projectMedia->delete();

        return response()->json([
            'status'    => true,
            'message'   => $message,
            'data'      => $projectMedia
        ],200);
    }
}
