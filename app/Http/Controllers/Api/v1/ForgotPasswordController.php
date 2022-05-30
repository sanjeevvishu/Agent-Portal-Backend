<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon; 
use App\Models\User; 

class ForgotPasswordController extends Controller 
{

  
    public function showForgetPasswordForm()
    {
        return view('auth.forgetPassword');
    }


    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
        ]);

        $user = User::where('email', $request->email)->first();

        Mail::send('portal_email.forgetPassword', ['user' => $user,'token' => $token,'email' => $request->email], function($message) use($request){
        $message->to($request->email);
        $message->subject('Reset Password');
        });

        return response()->json([
            'status'  => true, 
            'message' => 'We have e-mailed your password reset link!',
        ], 200);
    }


    public function showResetPasswordForm($token) { 
        return view('auth.forgetPasswordLink', ['token' => $token]);
    }

   
    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')->where([
        'email' => $request->email, 
        'token' => $request->token
        ])->first();

        if(!$updatePassword){
            return response()->json([
                'status'  => false, 
                'message' => 'Validation Error!',
                'errors'  => ['email' => ["Invalid token!"]]
            ], 422);
        }

        $user = User::where('email', $request->email)->first();
        User::where('id', $user->id)->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        Mail::send('portal_email.newPasswordUpdated', ['user' =>$user], function($message) use($request){
            $message->to($request->email);
            $message->subject('New Password Updated');
        });


        return response()->json([
            'status'  => true, 
            'message' => 'Password has been changed successfully.',
        ], 200);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|min:8',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);

        $user = $request->user();

        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json([
                'status'  => false, 
                'message' => 'Validation Error!',
                'errors'  => ['password' => ['Invalid old Password.']]
            ], 422);
        }

        User::where('id', $user->id)->update(['password' => Hash::make($request->password)]);

        Mail::send('portal_email.newPasswordUpdated', ['user' => $user], function($message) use($user){
            $message->to($user->email);
            $message->subject('New Password Updated');
        });

        return response()->json([
            'status'  => true, 
            'message' => 'New Password has been changed successfully.',
        ], 200);
    }

}