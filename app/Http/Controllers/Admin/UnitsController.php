<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Models\Project;
use Illuminate\Http\Request;

class UnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project, Request $request)
    {
        $searchData = [];
        $unitsQuery = Unit::where('id','>',0);
        if ($request->filled('key') && $request->filled('value')) {
            $searchData = $request->all();
            $searchText = $request->value;
            $searchColumn = $request->key;
            $unitsQuery->where($searchColumn, 'like', '%' . $searchText . '%');
        }  
        $unitsQuery->latest('id');

        $units = $unitsQuery->paginate(15);
        $units->appends($searchData);
        
        return view('admin.units.index', compact('units','project', 'searchData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        return view('admin.units.create',compact('project'));
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
            //'project_id' => 'required|number',
            'cubedots_id' => 'required|max:75|unique:units',
            'apartment_id' => 'required|max:75|unique:units',
            'price_local' => 'required|regex:/^\d+(\.\d{1,8})?$/',
            'price_international' => 'required|regex:/^\d+(\.\d{1,8})?$/',
            'status' => 'required|max:75',
            'built_up_area' => 'required|regex:/^\d+(\.\d{1,8})?$/',
            'block' => 'required|max:75',
            'floor' => 'required|max:75',
            'bedroom' => 'required|max:75',
            'checks' => 'required|max:75',
            'unit_number' => 'required|max:75',
            'unit_id' => 'required|max:75',
            'unit_type' => 'required|max:75',
            'layout' => 'nullable|max:75',
            'direction' => 'nullable|max:75',
            'balcony' => 'nullable|max:75',
            'terrace' => 'nullable|max:75',
            'private_parking' => 'nullable|max:75',
            'views' => 'nullable|max:75',
            'is_published' => 'required|max:75',
            
        ]);
      
        $inputs = $request->all();
        $inputs['created_user_id'] = $user->id;
        $unit = new Unit();
        $unit['project_id'] = $project->id;
        $unit->fill($inputs);
        $unit->save();
        
        return redirect(route('admin.projects.units.index',$project->id))->with('flash_success', 'Unit created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project, Unit $unit)
    {
        return view('admin.units.show', compact('unit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        return view('admin.units.edit', compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        $user = $request->user();
        $request->validate([
            'cubedots_id' => 'required|max:75|unique:units,cubedots_id,' . $unit->id,
            'apartment_id' => 'required|max:75|unique:units,apartment_id,' . $unit->id,
            'price_local' => 'required|regex:/^\d+(\.\d{1,8})?$/',
            'price_international' => 'required|regex:/^\d+(\.\d{1,8})?$/',
            'status' => 'required|max:75',
            'built_up_area' => 'required|regex:/^\d+(\.\d{1,8})?$/',
            'block' => 'required|max:75',
            'floor' => 'required|max:75',
            'bedroom' => 'required|max:75',
            'checks' => 'required|max:75',
            'unit_number' => 'required|max:75',
            'unit_id' => 'required|max:75',
            'unit_type' => 'required|max:75',
            'layout' => 'nullable|max:75',
            'direction' => 'nullable|max:75',
            'balcony' => 'nullable|max:75',
            'terrace' => 'nullable|max:75',
            'private_parking' => 'nullable|max:75',
            'views' => 'nullable|max:75',
            'is_published' => 'required|max:75',
        ]);

        $inputs = $request->all();
        $inputs['updated_user_id'] = $user->id;
        $unit->fill($inputs);
        $unit->save();

        return redirect(route('admin.projects.units.index',$unit->project_id))->with('flash_success', 'Unit updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        $unit->delete();
        return redirect(route('admin.projects.units.index',$unit->project_id))->with('flash_success', 'Unit deleted successfully.');
    }
}
