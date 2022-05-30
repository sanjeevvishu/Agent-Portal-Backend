<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectMedia;
use App\Models\CuVerseCategory;
use App\Models\CuVerse;
use Illuminate\Support\Facades\Storage;

class CuVerseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function projects()
    {
        $projects = Project::with('banners')->where('status',1)->latest()->get();
        return response()->json([
            'status'  => true, 
            'message' => 'success',
            'data'    => $projects
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $project
     * @return \Illuminate\Http\Response
     */
    public function project($project)
    {   
        $projectQuery = Project::with('banners')->where('status',1)->select('id','title','slug');   

        if(is_numeric($project))
            $projectQuery->where('id',$project);
        else
            $projectQuery->where('slug',$project);
        
        $project = $projectQuery->first();

        if(!$project)
        return response()->json([
            'status'    => false,
            'message'   => 'data errors',
            'errors'    => 'Project not found.',
        ],422);

        return response()->json([
            'status'  => true, 
            'message' => 'success',
            'data'    => $project
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $project
     * @return \Illuminate\Http\Response
     */
    public function categories($project)
    {   
        $projectQuery = Project::where('status',1);   
        $projectQuery->where('id',$project);
        $project = $projectQuery->first();

        if(!$project)
        return response()->json([
            'status'    => false,
            'message'   => 'data errors',
            'errors'    => 'Project not found.',
        ],422);
        
        $cuVerseCategoryIds = CuVerse::where('project_id',$project->id)->pluck('cu_verse_category_id')-all();
        $cuVerseCategories =  CuVerseCategory::with('cuVerseMedia')->whereIn('id',$cuVerseCategoryIds)->orderBy('title','ASC')->get();
        
        return response()->json([
            'status'  => true, 
            'message' => 'success',
            'data'    => $cuVerseCategories
        ], 200);
    }


    public function mediaFiles($project)
    {   
        $projectQuery = Project::where('status',1);   
        $projectQuery->where('id',$project);
        $project = $projectQuery->first();

        if(!$project)
        return response()->json([
            'status'    => false,
            'message'   => 'data errors',
            'errors'    => 'Project not found.',
        ],422);
        
        // $cuVerseCategoryIds = CuVerse::where('project_id',$project->id)->pluck('cu_verse_category_id')-all();
        // $cuVerseCategories =  CuVerseCategory::with('cuVerseMedia')->whereIn('id',$cuVerseCategoryIds)->orderBy('title','ASC')->get();
        
        // {
        //     "name": "Important Documents",
        //     "type": "folder",
        //     "path": "files/Important Documents",
        //     "items": [
        //         {
        //             "name": "Microsoft Office",
        //             "type": "folder",
        //             "path": "files/Important Documents/Microsoft Office",
        //             "items": [
        //                 {
        //                     "name": "Geography.doc",
        //                     "type": "file",
        //                     "path": "files/Important Documents/Microsoft Office/Geography.doc",
        //                     "size": 4096
        //                 },
        //                 {
        //                     "name": "Table.xls",
        //                     "type": "file",
        //                     "path": "files/Important Documents/Microsoft Office/Table.xls",
        //                     "size": 204800
        //                 }
        //             ]
        //         },
        //         {
        //             "name": "export.csv",
        //             "type": "file",
        //             "path": "files/Important Documents/export.csv",
        //             "size": 4096
        //         }
        //     ]
        // }

        $data = [];
        $cuVerseCategories =  CuVerseCategory::where('status',1)->orderBy('title','ASC')->get();
        if($cuVerseCategories->isNotEmpty()){
            foreach($cuVerseCategories as $row){
                $data[] = [
                    "name" => $row->title,
                    "type" => "folder",
                    "path" => "files/".$row->title,
                    "items" => $this->getCuVerseFiles($project->id, $row->id)
                ];
            }
        }

        $cuVerseCategories = [
            "name" => "files",
            "type" => "folder",
            "path" => "files",
            "items" => $data
        ];

        return response()->json([
            'status'  => true, 
            'message' => 'success',
            'data'    => $cuVerseCategories
        ], 200);
    }

    private function getCuVerseFiles($project_id, $category_id)
    {
        $cuVerseFiles =  CuVerse::where('project_id',$project_id)->where('cu_verse_category_id',$category_id)->orderBy('id','ASC')->get();
        $files = [];
        if($cuVerseFiles->isNotEmpty()){
            foreach($cuVerseFiles as $row){
                $files[] = [
                    'id' => $row->id,
                    "name" => $row->file_name,
                    "type" => "file",
                    "path" =>  Storage::disk('s3')->url($row->file_s3_path),
                    "size" => $row->file_size,
                    "mime_type" => $row->file_mime_type,
                    "visibility" => $row->visibility,
                    "language" => $row->language
                ];
            }
        }
        return $files;
    }

    public function download($id)
    {   
        $cuVerse = CuVerse::where('id',$id)->first();
        
        if(!$cuVerse)
        return response()->json([
            'status'    => false,
            'message'   => 'data errors',
            'errors'    => 'media not found.',
        ],404);
        
        $url = Storage::disk('s3')->url($cuVerse->file_s3_path);
        $headers = [
            'Content-Type'        => $cuVerse->file_mime_type,            
            'Content-Disposition' => 'attachment; filename="'. $cuVerse->file_name .'"',
         ];
        return Storage::disk('s3')->download($cuVerse->file_s3_path,$cuVerse->file_name,$headers);
        //return \Response::make(Storage::disk('s3')->get($cuVerse->file_s3_path), 200, $headers);
    }

}
