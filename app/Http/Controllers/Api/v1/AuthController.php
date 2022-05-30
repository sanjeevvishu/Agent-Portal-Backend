<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserSessionLog;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*validation*/
        /* $validatedData = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required'
        ]);*/

        $validatedData = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        /* if ($validatedData->fails()){
            return response()->json([
                'status'  => false, 
                'message' => 'validation errors',
                'errors'  => $validatedData->errors()
            ], 422);
        }*/

        /*check auth*/
        $credentials = $request->only('email');
        $user = User::where($credentials)->first();

        if (!$user) {
            return response()->json([
                'status'  => false, 
                'message' => 'Unauthorised',
                'errors'  => ['email' => ["This email doesn't match a cuengine account."]]
            ], 422);
        }
    
        $requestPassword = $request->input('password');
        $hashedPassword = $user->password;
    
        if (!Hash::check($requestPassword, $hashedPassword)) {
            return response()->json([
                'status'  => false, 
                'message' => 'Unauthorised',
                'errors'  => ['password' => ['Invalid Credentials.']]
            ], 422);
        }
        
        //$user->pcode = base64_encode($request->password);
        $user->save();
        UserSessionLog::create([
            'user_id'       => $user->id ,
            'session_type'  => 'api', 
            'logged_from'   => 'v1', 
            'ip_address'    => $request->ip(), 
            'user_agent'    => $request->header('User-Agent')
        ]);
            
        /* create token */
        $token = $user->createToken('portal');
        //$accessToken = $user->createToken('authToken')->accessToken;


        $data = [
            'token' => $token->accessToken, 
            //'user_id' => $user->id, 
            'user' => $user,
            'expires_at' => $token->token->expires_at->diffInMinutes()
        ];

        return response()->json([
            'status'  => true, 
            'message' => 'success',
            'data'    => $data
        ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
