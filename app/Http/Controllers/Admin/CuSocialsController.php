<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\CuSocial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CuSocialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchData = [];
        $cuSocialsQuery = CuSocial::where('id','>',0);
        if ($request->filled('key') && $request->filled('value')) {
            $searchData = $request->all();
            $searchText = $request->value;
            $searchColumn = $request->key;
            $cuSocialsQuery->where($searchColumn, 'like', '%' . $searchText . '%');
        }  
        $cuSocialsQuery->latest('id');

        $cuSocials = $cuSocialsQuery->paginate(15);
        $cuSocials->appends($searchData);
        
        return view('admin.cuSocials.index', compact('cuSocials', 'searchData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = [
            'general'       =>'general', 
            'offers'         => 'offers',
            //'announcement'  => 'announcement',
            'blog'          => 'blog',
           // 'video'         => 'video'
        ];
        return view('admin.cuSocials.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'                 => 'required|max:190',
            'category'              => 'required|max:190',
            'small_description'     => 'nullable|max:150',
            'medium_description'    => 'nullable|max:250',
            'long_description'      => 'required',
            'status'                => 'required|max:10',
        ]);
      
        $inputs = $request->all();
        $cuSocial = new CuSocial();
        $inputs['slug'] = \Illuminate\Support\Str::of($inputs['title'])->slug('-');


        if ($request->hasfile('featured_image')) {
            $projectMediaType= 'featured_image';
            $image           = $request->file('featured_image');
            //$fileSize       = $image->getSize();
            $fileName        = time() . '_' . $image->getClientOriginalName();
            //$fileMimeType    = $image->getMimeType();
            $filePath = 'cusocials/' . $projectMediaType . '/' . $fileName;
            Storage::disk('s3')->put($filePath, $image->get());
            $inputs['featured_image'] = $filePath;
        }

        $cuSocial->fill($inputs);
        $cuSocial->save();
        
        return redirect(route('admin.cuSocials.index'))->with('flash_success', 'CuSocial created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CuSocial  $cuSocial
     * @return \Illuminate\Http\Response
     */
    public function show(CuSocial $cuSocial)
    {
        return view('admin.cuSocials.show', compact('cuSocial'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CuSocial  $cuSocial
     * @return \Illuminate\Http\Response
     */
    public function edit(CuSocial $cuSocial)
    {
        $categories = [
            'general'       =>'general', 
            'offers'         => 'offers',
            //'announcement'  => 'announcement',
            'blog'          => 'blog',
            //'video'         => 'video'
        ];
        return view('admin.cuSocials.edit', compact('categories','cuSocial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CuSocial  $cuSocial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CuSocial $cuSocial)
    {
        $request->validate([
            'title'                 => 'required|max:190',
            'category'              => 'required|max:190',
            'small_description'     => 'nullable|max:150',
            'medium_description'    => 'nullable|max:250',
            'long_description'      => 'required',
            'status'                => 'required|max:10',
        ]);
        $inputs = $request->all();
        $inputs['slug'] = \Illuminate\Support\Str::of($inputs['title'])->slug('-');
        
        if ($request->hasfile('featured_image')) {
            $projectMediaType= 'featured_image';
            $image           = $request->file('featured_image');
            //$fileSize       = $image->getSize();
            $fileName        = time() . '_' . $image->getClientOriginalName();
            //$fileMimeType    = $image->getMimeType();
            $filePath = 'cusocials/'. $projectMediaType . '/' . $fileName;
            Storage::disk('s3')->put($filePath, $image->get());

            if(Storage::disk('s3')->exists($cuSocial->featured_image)){
                Storage::disk('s3')->delete($cuSocial->featured_image);
            }

            $inputs['featured_image'] = $filePath;
        }

        $cuSocial->fill($inputs);
        $cuSocial->save();

        return redirect(route('admin.cuSocials.index'))->with('flash_success', 'CuSocial updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CuSocial  $cuSocial
     * @return \Illuminate\Http\Response
     */
    public function destroy(CuSocial $cuSocial)
    {
        // if(Storage::disk('s3')->exists($cuSocial->featured_image)){
        //     $message = ('Media deleted.');
        //     Storage::disk('s3')->delete($cuSocial->featured_image);
        // }else{
        //     $message = ('Media File does not exists.');
        // }

        $cuSocial->delete();
        return redirect(route('admin.cuSocials.index'))->with('flash_success', 'CuSocial deleted successfully.');
    }
}
