<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\CuVerseCategory;
use Illuminate\Http\Request;

class CuVerseCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchData = [];
        $cuVerseCategoriesQuery = CuVerseCategory::where('id','>',0);
        if ($request->filled('key') && $request->filled('value')) {
            $searchData = $request->all();
            $searchText = $request->value;
            $searchColumn = $request->key;
            $cuVerseCategoriesQuery->where($searchColumn, 'like', '%' . $searchText . '%');
        }  
        $cuVerseCategoriesQuery->latest('id');

        $cuVerseCategories = $cuVerseCategoriesQuery->paginate(15);
        $cuVerseCategories->appends($searchData);
        
        return view('admin.cuVerseCategories.index', compact('cuVerseCategories', 'searchData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cuVerseCategories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $request->validate([
            'title'           => 'required|max:190',
            'description'     => 'nullable|string',
            'status'          => 'required|max:10',
        ]);
      
        $inputs = $request->all();
        $cuVerseCategory = new CuVerseCategory();
        $inputs['slug'] = \Illuminate\Support\Str::of($inputs['title'])->slug('-');
        $inputs['created_user_id'] = $user->id;

        $cuVerseCategory->fill($inputs);
        $cuVerseCategory->save();
        
        return redirect(route('admin.cuVerseCategories.index'))->with('flash_success', 'CuVerse category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CuVerseCategory  $cuVerseCategory
     * @return \Illuminate\Http\Response
     */
    public function show(CuVerseCategory $cuVerseCategory)
    {
        return view('admin.cuVerseCategories.show', compact('cuVerseCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CuVerseCategory  $cuVerseCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(CuVerseCategory $cuVerseCategory)
    {
        return view('admin.cuVerseCategories.edit', compact('cuVerseCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CuVerseCategory  $cuVerseCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CuVerseCategory $cuVerseCategory)
    {
        $user = $request->user();
        $request->validate([
            'title'           => 'required|max:190',
            'description'     => 'nullable|string',
            'status'          => 'required|max:10',
        ]);
        $inputs = $request->all();
        $inputs['slug'] = \Illuminate\Support\Str::of($inputs['title'])->slug('-');
        $inputs['updated_user_id'] = $user->id;
        $cuVerseCategory->fill($inputs);
        $cuVerseCategory->save();

        return redirect(route('admin.cuVerseCategories.index'))->with('flash_success', 'CuVerse category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CuVerseCategory  $cuVerseCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(CuVerseCategory $cuVerseCategory)
    {
        $cuVerseCategory->delete();
        return redirect(route('admin.cuVerseCategories.index'))->with('flash_success', 'CuVerse category deleted successfully.');
    }
}
