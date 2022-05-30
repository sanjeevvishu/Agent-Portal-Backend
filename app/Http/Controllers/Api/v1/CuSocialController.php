<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CuSocial;

class CuSocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function latestHome()
    {
        $cusocials = CuSocial::where('category','general')->where('status',1)->latest()->limit(4)->get();
        return response()->json([
            'status'  => true, 
            'message' => 'success',
            'data'    => $cusocials
        ], 200);
    }

    public function latestByCategory($category)
    {
        $cusocials = CuSocial::where('status',1)->where('category',$category)->latest()->limit(20)->get();
        return response()->json([
            'status'  => true, 
            'message' => 'success',
            'data'    => $cusocials
        ], 200);
    }

    public function byCategory($category)
    {
        $cusocials = CuSocial::where('status',1)->where('category',$category)->latest()->get();
        return response()->json([
            'status'  => true, 
            'message' => 'success',
            'data'    => $cusocials
        ], 200);
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $project
     * @return \Illuminate\Http\Response
     */
    public function show($cusocial)
    {   
        $cusocialQuery = CuSocial::where('status',1);
        if(is_numeric($cusocial))
            $cusocialQuery->where('id',$cusocial);
        else
            $cusocialQuery->where('slug',$cusocial);
        
        $cusocial = $cusocialQuery->first();

        if(!$cusocial)
        return response()->json([
            'status'    => false,
            'message'   => 'data errors',
            'errors'    => 'cusocial not found.',
        ],422);

        return response()->json([
            'status'  => true, 
            'message' => 'success',
            'data'    => $cusocial
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
