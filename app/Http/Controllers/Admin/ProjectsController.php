<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Amenity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchData = [];
        $projectsQuery = Project::where('id','>',0);
        if ($request->filled('key') && $request->filled('value')) {
            $searchData = $request->all();
            $searchText = $request->value;
            $searchColumn = $request->key;
            $projectsQuery->where($searchColumn, 'like', '%' . $searchText . '%');
        }  
        $projectsQuery->latest('id');
        //$projectsQuery->orderBy('status', 'asc');
        $projects = $projectsQuery->paginate(15);
        $projects->appends($searchData);
        
        return view('admin.projects.index', compact('projects', 'searchData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $amenities = Amenity::where('status',1)->orderBy('title','ASC')->pluck('title','slug')->all();
        return view('admin.projects.create',compact('amenities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $request->validate([
            'title'                 => 'required|max:190',
            'small_description'     => 'required|max:150',
            'medium_description'    => 'required|max:650',
            'long_description'      => 'required',
            'status'                => 'required|max:10',
        ]);
      
        $inputs = $request->all();
        $project = new Project();
        $inputs['slug'] = \Illuminate\Support\Str::of($inputs['title'])->slug('-');
        $inputs['created_user_id'] = $user->id;

        if ($request->hasfile('logo_image')) {
            $folderName     = $project->id;
            $projectMediaType= 'logo_image';
            $image           = $request->file('logo_image');
            //$fileSize       = $image->getSize();
            $fileName        = time() . '_' . $image->getClientOriginalName();
            //$fileMimeType    = $image->getMimeType();
            $filePath = 'project_media/' . $folderName . '/' . $projectMediaType . '/' . $fileName;
            Storage::disk('s3')->put($filePath, $image->get());
            $inputs['logo_image'] = $filePath;
        }

        if ($request->hasfile('featured_image')) {
            $folderName     = $project->id;
            $projectMediaType= 'featured_image';
            $image           = $request->file('featured_image');
            //$fileSize       = $image->getSize();
            $fileName        = time() . '_' . $image->getClientOriginalName();
            //$fileMimeType    = $image->getMimeType();
            $filePath = 'project_media/' . $folderName . '/' . $projectMediaType . '/' . $fileName;
            Storage::disk('s3')->put($filePath, $image->get());
            $inputs['featured_image'] = $filePath;
        }

        $project->fill($inputs);
        $project->save();
        
        return redirect(route('admin.projects.index'))->with('flash_success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //dd($project);
        $amenities = Amenity::where('status',1)->orderBy('title','ASC')->pluck('title','slug')->all();
        return view('admin.projects.edit', compact('amenities','project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $user = $request->user();
        $request->validate([
            'title'                 => 'required|max:190',
            'small_description'     => 'required|max:150',
            'medium_description'    => 'required|max:650',
            'long_description'      => 'required',
            'status'                => 'required|max:10',
        ]);
        $inputs = $request->all();
        $inputs['slug'] = \Illuminate\Support\Str::of($inputs['title'])->slug('-');
        $inputs['updated_user_id'] = $user->id;

        if ($request->hasfile('logo_image')) {
            if(Storage::disk('s3')->exists($project->logo_image)){
                Storage::disk('s3')->delete($project->logo_image);
            }
            $folderName     = $project->id;
            $projectMediaType= 'logo_image';
            $image           = $request->file('logo_image');
            //$fileSize       = $image->getSize();
            $fileName        = time() . '_' . $image->getClientOriginalName();
            //$fileMimeType    = $image->getMimeType();
            $filePath = 'project_media/' . $folderName . '/' . $projectMediaType . '/' . $fileName;
            Storage::disk('s3')->put($filePath, $image->get());
            $inputs['logo_image'] = $filePath;
        }

        if ($request->hasfile('featured_image')) {
            if(Storage::disk('s3')->exists($project->featured_image)){
                Storage::disk('s3')->delete($project->featured_image);
            }
            $folderName     = $project->id;
            $projectMediaType= 'featured_image';
            $image           = $request->file('featured_image');
            //$fileSize       = $image->getSize();
            $fileName        = time() . '_' . $image->getClientOriginalName();
            //$fileMimeType    = $image->getMimeType();
            $filePath = 'project_media/' . $folderName . '/' . $projectMediaType . '/' . $fileName;
            Storage::disk('s3')->put($filePath, $image->get());
            $inputs['featured_image'] = $filePath;
        }

        $project->fill($inputs);
        $project->save();

        return redirect(route('admin.projects.index'))->with('flash_success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect(route('admin.projects.index'))->with('flash_success', 'Project deleted successfully.');
    }

    public function storeLogo(Project $project, Request $request)
    {
    
        
        if ($request->hasfile('logo_file')) {

         
            $folderName     = $project->id;
            $image           = $request->file('logo_file');
            $fileSize       = $image->getSize();
            $fileName        = time() . '_' . $image->getClientOriginalName();
            $fileMimeType    = $image->getMimeType();
            $filePath = 'project_media/' . $folderName . '/' . $projectMediaType . '/' . $fileName;
            
            Storage::disk('s3')->put($filePath, $image->get());

            $inputs = [
                "project_id"        => $project->id,
                'file_name'         => $fileName,
                'asset_type'        => $projectMediaType,
                "local_path"        => $filePath,
               // "s3_path"           => env('CLOUDFRONT_URL') . '/' . $filePath,
                "file_mime_type"    => $fileMimeType,
                "file_size"         => $fileSize,
                "category"          => $request->category ? strtolower($request->category) : null,
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
}
