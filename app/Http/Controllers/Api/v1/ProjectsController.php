<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Project;
use App\Models\ProjectMedia;
use App\Models\Unit;


class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function featuredHome()
    {
        $projects = Project::with('banners')->where('status',1)->orderBy('display_priority','asc')->get();
        
        return response()->json([
            'status'  => true, 
            'message' => 'success',
            'data'    => $projects
        ], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $inputs = $request->all();
        $projects = Project::with('banners')->where('status',1)->orderBy('display_priority','asc')->get();
        //$projectss = Project::with('banners')->where('status',1)->groupBy('status')->orderBy('status','DESC')->all();
        $data = Project::where('status',1)->selectRaw('MIN(min_price) AS min_price, MAX(max_price) AS max_price, MIN(min_built_up_area) AS min_built_up_area, MAX(max_built_up_area) AS max_built_up_area')->first();
        $cities = Project::where('status',1)->groupBy('city')->orderBy('city','ASC')->pluck('city')->all();
        $data['cities'] = $cities;
        
        return response()->json([
            'status'  => true, 
            'message' => 'success',
            'data' => [
                'filters'   => $data,
                'projects'  => $projects,
            ]
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $project
     * @return \Illuminate\Http\Response
     */
    public function show($project)
    {   
        //return $project;
        $projectQuery = Project::with('banners','gallery','floorplan','view')->where('status',1);    
        //$project = 
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
     * Display the specified resource unit list.
     *
     * @param  int  $project
     * @return \Illuminate\Http\Response
     */
    public function units($project)
    {

        // $units = Unit::where('is_published',1)->where('project_id',$project->id)->get();
        // return response()->json([
        //     'status'  => true, 
        //     'message' => 'success',
        //     'data'    => $units
        // ], 200);

        $projectQuery = Project::where('status',1); 
        //$projectQuery->where('id',$project);   
        //$project = 
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


        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->get('https://reservation.cuengine.com/api/v7/project/unitList/'.$project->res_project_id);
        
         if($response->successful()){
            return response()->json([
                'status'        => true, 
                'status_code'   => $response->status(), 
                'project'       => $project->only('id','title','slug','small_description','currency_symbol'),
                'data'          => $response->json()
            ], 200);
            
        }else{
            return response()->json([
                'status'        => false, 
                'status_code'   => $response->status(), 
                'project'       => $project->only('id','title','slug','small_description','currency_symbol'),
                'data'          => $response->status() == 200 ? $response->json() : [],
                'errors'        => $response->status() != 200 ? $response->json() : [],
            ], 422);
        }

    }

      /**
     * Display the specified resource unit show.
     *
     * @param  int  $project
     * @return \Illuminate\Http\Response
     */
    public function unitShow(Project $project,Unit $unit)
    {
        $unit = $unit->where('is_published',1)->where('project_id',$project->id)->first();
        return response()->json([
            'status'  => true, 
            'message' => 'success',
            'data'    => $unit
        ], 200);
    }

     /**
     * Display the specified resource unit show.
     *
     * @param  int  $project
     * @return \Illuminate\Http\Response
     */
    public function media(Request $request, Project $project)
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

        $projectMedia = ProjectMedia::where('project_id',$project->id)->where('asset_type',$request->asset_type)->latest()->get();
        return response()->json([
            'status'        => true, 
            'message'       => 'success',
            'asset_type'    => $request->asset_type,
            'data'          => $projectMedia
        ], 200);
    }

    public function interiorInventory($project,$apartment_id)
    {

        $projectQuery = Project::with('gallery','floorplan','view')->where('status',1);  
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

       

        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->get('https://reservation.cuengine.com/api/v7/project/inventory/interior/'.$project->res_project_id.'/'.$apartment_id);
        
         if($response->status()===200){
            $interior = $response->json();
            $floorplan = null;
            if($project->floorplan->isNotEmpty()){
                foreach($project->floorplan as $row){
                    $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $row->file_name);
                    //dd($withoutExt , $interior['data']['layout_image_name'], $interior);
                    if($withoutExt == $interior['data']['layout_image_name']){
                        $floorplan = $row;
                    }
                }  
            }

          
            return response()->json([
                'status'        => true, 
                'status_code'   => $response->status(), 
                'project'       => $project->only('id','title','slug','small_description','currency_symbol','gallery','floorplan','view'),
                'floorplans'     => $floorplan,
                //'project'     => $project->only('id','project_id','unique_id','phase','block','apartment_id','apartment_type','scane_name','layout_image_name','checks'),
                'data'          => $response->json()
            ], 200);
            
        }else{
            return response()->json([
                'status'        => false, 
                'status_code'   => $response->status(), 
                'project'       => $project->only('id','title','slug','small_description','currency_symbol'),
                'data'          => $response->status() == 200 ? $response->json() : [],
                'errors'        => $response->status() != 200 ? $response->json() : [],
            ], 422);
        }

    }
}
