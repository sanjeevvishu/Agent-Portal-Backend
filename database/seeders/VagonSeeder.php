<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class VagonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // php artisan db:seed --class=VagonSeeder
        
        $users = User::all();
        if($users->isNotEmpty()){
            foreach($users as $row){
                $vagon = $this->createUser($row);
                if($vagon['status']){
                    if(!$vagon['data']['vagon_id']){
                    User::where('id', $row->id)->update(['vagon_id' => $vagon['data']['id']]);
                    }
                }
            }
        }
    }

    public function createUser($user)
    {
       
        $vagon_request_method = 'POST';
        $vagon_base_url = 'https://sandbox-api.vagon.io';
        $vagon_request_path = '/app-stream-management/v1/users';
        $vagon_api_key = 'a00d15a2-0630-4d95-8264-69397f4987d1';
        $vagon_secret = '56574d9881574f6f8ab5bfba854db28a';

        $timestamp = round(microtime(true) * 1000);;
        $nonce = rand(0000, 9999999);
        $post_data = [ 'email' =>$user->email ];
        $request_body = json_encode($post_data);
        $payload = $vagon_api_key.$vagon_request_method.$vagon_request_path.$timestamp.$nonce.$request_body;
        $signature = hash_hmac('sha256', $payload, $vagon_secret);
        $auth = "HMAC $vagon_api_key:$signature:$nonce:$timestamp";
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $auth
        ])->post($vagon_base_url.$vagon_request_path,$post_data);
        
        if($response->status()===200){
            return  [
                'status'  => true, 
                'message' => 'success',
                'data'    => $response->json()
            ];
        }else{
           return  [
            'status'    => false,
            'message'   => 'data errors',
            'errors'    => $response->json(),
            ];
        }
    }
}
