<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Project;
use App\Models\VagonApp;
use Illuminate\Http\Request;

class VagonAppsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project, Request $request)
    {
        $searchData = [];
        $vagonAppsQuery = VagonApp::where('project_id',$project->id);
        if ($request->filled('key') && $request->filled('value')) {
            $searchData = $request->all();
            $searchText = $request->value;
            $searchColumn = $request->key;
            $vagonAppsQuery->where($searchColumn, 'like', '%' . $searchText . '%');
        }  
        $vagonAppsQuery->latest('id');

        $vagonApps = $vagonAppsQuery->paginate(15);
        $vagonApps->appends($searchData);
        
        return view('admin.vagonapps.index', compact('vagonApps','project', 'searchData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        return view('admin.vagonapps.create',compact('project'));
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
        $request->validate([
            'vagon_stream_url'  => 'required',
            // 'vagon_app_id'  => 'required|max:75',
            // 'region'        => 'required|max:75',
            'status'        => 'required|max:75',
        ]);
      
        $inputs = $request->all();
        $inputs['created_user_id'] = $user->id;
        $vagonApp = new VagonApp();
        $vagonApp['project_id'] = $project->id;
        $vagonApp->fill($inputs);
        $vagonApp->save();
        
        return redirect(route('admin.projects.vagonapps.index',$project->id))->with('flash_success', 'VagonApp created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VagonApp  $vagonApp
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project,VagonApp $vagonApp)
    {
        return view('admin.vagonapps.show', compact('vagonApp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VagonApp  $vagonApp
     * @return \Illuminate\Http\Response
     */
    public function edit(VagonApp $vagonapp)
    {
        return view('admin.vagonapps.edit', compact('vagonapp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VagonApp  $vagonApp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VagonApp $vagonapp)
    {
        $user = $request->user();
        $request->validate([
            'vagon_stream_url'  => 'required',
            // 'vagon_app_id'  => 'required|max:75',
            // 'region'        => 'required|max:75',
            'status'        => 'required|max:75',
        ]);

        $inputs = $request->all();
        $inputs['updated_user_id'] = $user->id;
        $vagonapp->fill($inputs);
        $vagonapp->save();

        return redirect(route('admin.projects.vagonapps.index',$vagonapp->project_id))->with('flash_success', 'VagonApp updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VagonApp  $vagonApp
     * @return \Illuminate\Http\Response
     */
    public function destroy(VagonApp $vagonapp)
    {
        $vagonapp->delete();
        return redirect(route('admin.projects.vagonapps.index',$vagonapp->project_id))->with('flash_success', 'VagonApp deleted successfully.');
    }
}
