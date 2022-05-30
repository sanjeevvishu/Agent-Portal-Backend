<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Amenity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AmenitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchData = [];
        $amenitiesQuery = Amenity::where('id','>',0);
        if ($request->filled('key') && $request->filled('value')) {
            $searchData = $request->all();
            $searchText = $request->value;
            $searchColumn = $request->key;
            $amenitiesQuery->where($searchColumn, 'like', '%' . $searchText . '%');
        }  
        $amenitiesQuery->latest('id');

        $amenities = $amenitiesQuery->paginate(15);
        $amenities->appends($searchData);
        
        return view('admin.amenities.index', compact('amenities', 'searchData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.amenities.create');
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
            'title'      => 'required|max:190',
            'icon_file'  => 'nullable|max:190',
            'status'     => 'required|max:10',
        ]);
      
        $inputs = $request->all();
        $amenity = new Amenity();
        $inputs['slug'] = \Illuminate\Support\Str::of($inputs['title'])->slug('-');
        $inputs['created_user_id'] = $user->id;
        
        if ($request->hasfile('icon_file')) {
            $projectMediaType= 'icon_file';
            $image           = $request->file('icon_file');
            //$fileSize       = $image->getSize();
            $fileName        = time() . '_' . $image->getClientOriginalName();
            //$fileMimeType    = $image->getMimeType();
            $filePath = 'amenities/' . $projectMediaType . '/' . $fileName;
            Storage::disk('s3')->put($filePath, $image->get());
            $inputs['s3_icon_path'] = $filePath;
        }

        $amenity->fill($inputs);
        $amenity->save();
        
        return redirect(route('admin.amenities.index'))->with('flash_success', 'Amenity created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Amenity  $amenity
     * @return \Illuminate\Http\Response
     */
    public function show(Amenity $amenity)
    {
        return view('admin.amenities.show', compact('amenity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Amenity  $amenity
     * @return \Illuminate\Http\Response
     */
    public function edit(Amenity $amenity)
    {
        return view('admin.amenities.edit', compact('amenity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Amenity  $amenity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Amenity $amenity)
    {
        $user = $request->user();
        $request->validate([
            'title'      => 'required|max:190',
            'icon_file'  => 'nullable|max:190',
            'status'     => 'required|max:10',
        ]);
        $inputs = $request->all();
        $inputs['slug'] = \Illuminate\Support\Str::of($inputs['title'])->slug('-');
        $inputs['updated_user_id'] = $user->id;
        
        if ($request->hasfile('icon_file')) {
            $projectMediaType= 'icon_file';
            $image           = $request->file('icon_file');
            //$fileSize       = $image->getSize();
            $fileName        = time() . '_' . $image->getClientOriginalName();
            //$fileMimeType    = $image->getMimeType();
            $filePath = 'amenities/' . $projectMediaType . '/' . $fileName;
            Storage::disk('s3')->put($filePath, $image->get());

            if(Storage::disk('s3')->exists($amenity->s3_icon_path)){
                Storage::disk('s3')->delete($amenity->s3_icon_path);
            }

            $inputs['s3_icon_path'] = $filePath;
        }

        $amenity->fill($inputs);
        $amenity->save();

        return redirect(route('admin.amenities.index'))->with('flash_success', 'Amenity updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Amenity  $amenity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Amenity $amenity)
    {
        // if(Storage::disk('s3')->exists($amenity->featured_image)){
        //     $message = ('Media deleted.');
        //     Storage::disk('s3')->delete($amenity->featured_image);
        // }else{
        //     $message = ('Media File does not exists.');
        // }

        $amenity->delete();
        return redirect(route('admin.amenities.index'))->with('flash_success', 'Amenity deleted successfully.');
    }
}
