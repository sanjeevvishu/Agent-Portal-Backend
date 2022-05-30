<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\CuVerse;
use App\Models\Project;
use App\Models\CuVerseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CuVersesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $searchData = [];
        // $cuVersesQuery = CuVerse::where('id','>',0);
        // if ($request->filled('key') && $request->filled('value')) {
        //     $searchData     = $request->all();
        //     $searchText     = $request->value;
        //     $searchColumn   = $request->key;
        //     $cuVersesQuery->where($searchColumn, 'like', '%' . $searchText . '%');
        // }  
        // $cuVersesQuery->latest('id');

        // $cuVerses = $cuVersesQuery->paginate(15);
        // $cuVerses->appends($searchData);

        $searchData = [];
        $projectsQuery = Project::where('created_user_id',0);
        if ($request->filled('key') && $request->filled('value')) {
            $searchData = $request->all();
            $searchText = $request->value;
            $searchColumn = $request->key;
            $projectsQuery->where($searchColumn, 'like', '%' . $searchText . '%');
        }  
        $projectsQuery->latest('id');

        $projects = $projectsQuery->paginate(15);
        $projects->appends($searchData);
        
        return view('admin.cuVerses.index', compact('projects', 'searchData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::where('status',1)->orderBy('title','ASC')->pluck('title','id')->all();
        $cuVerseCategories = CuVerseCategory::where('status',1)->orderBy('title','ASC')->pluck('title','id')->all();
        $languages = [
            ['id' => 'english','title' =>'English'],
            ['id' => 'arabic','title' =>'Arabic'],
            ['id' => 'persian','title' =>'Persian'],
            ['id' => 'russian','title' =>'Russian']
        ];
        return view('admin.cuVerses.create',compact('projects','cuVerseCategories','languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project)
    {
        $user = $request->user();
        if(!$project)
        return response()->json('Project not found.', 404);


        $validation = \Illuminate\Support\Facades\Validator::make($request->all(), [
            //'project_id' => 'required',
            'category' => 'required',
            'visibility' => 'required',
            'language' => 'required',
            'file'     => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors()->first(), 422);
        }
        
        if ($request->hasfile('file')) {

            $project_id = $project->id;
            $cu_verse_category_id = $request->input('category');
            $language = $request->input('language');
            $visibility = $request->input('visibility');
         
            $projectFolderName = $project->id;
            $image          = $request->file('file');
            $fileSize       = $image->getSize();
            $fileName       = $image->getClientOriginalName();
            $fileMimeType   = $image->getMimeType();
            $filePath = 'cuverse/' . $projectFolderName . '/' . $cu_verse_category_id . '/' . $language. '/' . $fileName;
            
            Storage::disk('s3') ->put($filePath, $image->get());

            $inputs = [
                "project_id"            => $project_id,
                "cu_verse_category_id"  => $cu_verse_category_id,
                "visibility"            => $visibility,
                "language"              => $language,
                'file_name'             => $fileName,
                "file_s3_path"          => $filePath,
                "file_mime_type"        => $fileMimeType,
                "file_size"             => $fileSize,
                'created_user_id'       => $user->id
            ];

            $cuVerse = new CuVerse();
            $cuVerse->fill($inputs);
            $cuVerse->save();

            return response()->json(['status' => true, 'message' => 'project media uploded successfully.'], 200);
        }
        return response()->json('Oops! Something missing.', 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CuVerse  $cuVerse
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
    
        $cuVerseCategories = CuVerseCategory::where('status',1)->orderBy('title','ASC')->select('id','title')->get()->toArray();
       // dd($cuVerseCategories);
       $cuVerseLanguages = [
            ['id' => 'english','title' =>'English'],
            ['id' => 'arabic','title' =>'Arabic'],
            ['id' => 'persian','title' =>'Persian'],
            ['id' => 'russian','title' =>'Russian']
        ];
        $cuVerseVisibilities = [
            ['id' => 'private','title' =>'Private'],
            ['id' => 'public','title' =>'Public'],
        ];

        return view('admin.cuVerses.show', compact('project','cuVerseCategories','cuVerseLanguages','cuVerseVisibilities'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CuVerse  $cuVerse
     * @return \Illuminate\Http\Response
     */
    public function edit(CuVerse $cuVerse)
    {
        $projects = Project::where('status',1)->orderBy('title','ASC')->pluck('title','id')->all();
        $cuVerseCategories = CuVerseCategory::where('status',1)->orderBy('title','ASC')->pluck('title','id')->all();
        
        return view('admin.cuVerseCategories.create',compact('projects','cuVerseCategories','cuVerse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CuVerse  $cuVerse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CuVerse $cuVerse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CuVerse  $cuVerse
     * @return \Illuminate\Http\Response
     */
    public function destroy(CuVerse $cuVerse)
    {
        //
    }

    public function list(Request $request, Project $project)
    {

        $cuVerse = CuVerse::with('category')->where('project_id', $project->id)->orderBy('cu_verse_category_id','ASC')->orderBy('id','DESC')->get();
        return response()->json([
            'status'    => true,
            'data'      => $cuVerse
        ],200);
    }

    public function delete(Project $project, CuVerse $cuVerse)
    {
    
        if(!$cuVerse){
            return response()->json([
                'status'    => false,
                'message'   => 'Media not found.',
                'data'      => $cuVerse
            ],422);
        }


        if(Storage::disk('s3')->exists($cuVerse->file_s3_path)){
            $message = ('Media deleted.');
            Storage::disk('s3')->delete($cuVerse->file_s3_path);
        }else{
            $message = ('Media File does not exists.');
        }
        $cuVerse->delete();

        return response()->json([
            'status'    => true,
            'message'   => $message,
            'data'      => $cuVerse
        ],200);
    }

}
