<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CuEvent;

class CuEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function latestHome()
    {
        $cuevents = CuEvent::where('status',1)->latest()->get();
        return response()->json([
            'status'  => true, 
            'message' => 'success',
            'data'    => $cuevents
        ], 200);
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $project
     * @return \Illuminate\Http\Response
     */
    public function show($cuevent)
    {   
        $cueventQuery = CuEvent::where('status',1);
        if(is_numeric($cuevent))
            $cueventQuery->where('id',$cuevent);
        else
            $cueventQuery->where('slug',$cuevent);
        
        $cuevent = $cueventQuery->first();

        if(!$cuevent)
        return response()->json([
            'status'    => false,
            'message'   => 'data errors',
            'errors'    => 'cuevent not found.',
        ],422);

        return response()->json([
            'status'  => true, 
            'message' => 'success',
            'data'    => $cuevent
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
