<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use App\Models\Project;
use App\Models\VagonApp;
use App\Models\VagonApiRequest;


class VagonController extends Controller
{   
    //sandbox
    // private $vagon_base_url = 'https://sandbox-api.vagon.io';
    // private $vagon_api_key = 'a00d15a2-0630-4d95-8264-69397f4987d1';
    // private $vagon_secret = '56574d9881574f6f8ab5bfba854db28a';

    //live
    private $vagon_base_url = 'https://api.vagon.io';
    private $vagon_api_key = 'd1eeee6b-67b0-4810-9fd6-d33a719f881e';
    private $vagon_secret = '166e8bb2b9ad4fc98e6320d5a2049955';


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createUser()
    {
       
        $vagon_request_method = 'POST';
        $vagon_base_url = 'https://sandbox-api.vagon.io';
        $vagon_request_path = '/app-stream-management/v1/users';
        $vagon_api_key = 'a00d15a2-0630-4d95-8264-69397f4987d1';
        $vagon_secret = '56574d9881574f6f8ab5bfba854db28a';

        $timestamp = round(microtime(true) * 1000);;
        $nonce = rand(0000, 9999999);
        $post_data = [ 'email' => 'jagdish@cubedots.com' ];
        // piping http_build_query and urldecode incorrectly serializes the body to use url param format instead of a valid JSON
        // using json_encode fixes that.
        // $request_body = urldecode(http_build_query($post_data));
        $request_body = json_encode($post_data);
        $payload = $vagon_api_key.$vagon_request_method.$vagon_request_path.$timestamp.$nonce.$request_body;
        $signature = hash_hmac('sha256', $payload, $vagon_secret);
        $auth = "HMAC $vagon_api_key:$signature:$nonce:$timestamp";
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $auth
        ])->post($vagon_base_url.$vagon_request_path,$post_data);
        
        if($response->successful()){
            //return ['status' => true, 'data' => $response->json()];
            return response()->json([
                'status'  => true, 
                'message' => 'success',
                'data'    => $response->json()
            ], 200);
        }else{
            //return $response->status();
           // return ['status' => false, 'errors' => $response->json()];
           return response()->json([
            'status'    => false,
            'message'   => 'data errors',
            'errors'    => $response->json(),
            ],422);
        }
    }
    
    public function startStream(Request $request)
    {
        $application_id = 6;
        $vagon_request_method = 'POST';
        $vagon_base_url = 'https://sandbox-api.vagon.io';
        $vagon_request_path = '/app-stream-management/v1/applications/'.$application_id.'/streams/create';
        $vagon_api_key = 'a00d15a2-0630-4d95-8264-69397f4987d1';
        $vagon_secret = '56574d9881574f6f8ab5bfba854db28a';

        $timestamp = round(microtime(true) * 1000);;
        $nonce = rand(0000, 9999999);
        $post_data = [ 'application_id' => 1, 'region' => 'dublin' ];
        $request_body = json_encode($post_data);
        $payload = $vagon_api_key.$vagon_request_method.$vagon_request_path.$timestamp.$nonce.$request_body;
        $signature = hash_hmac('sha256', $payload, $vagon_secret);
        $auth = "HMAC $vagon_api_key:$signature:$nonce:$timestamp";
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $auth
        ])->post($vagon_base_url.$vagon_request_path,$post_data);

        if($response->successful()){
           return ['status' => true, 'data' => $response->json()];
        }else{
            //return $response->status();
            return ['status' => false, 'errors' => $response->json()];
        }
    }

    public function assigningStreamSessionToUser(Request $request)
    {
        $application_id = 6;
        $vagon_request_method = 'POST';
        $vagon_base_url = 'https://sandbox-api.vagon.io';
        $vagon_request_path = '/app-stream-management/v1/applications/'.$application_id.'/streams/assign';
        $vagon_api_key = 'a00d15a2-0630-4d95-8264-69397f4987d1';
        $vagon_secret = '56574d9881574f6f8ab5bfba854db28a';

        $timestamp = round(microtime(true) * 1000);;
        $nonce = rand(0000, 9999999);
        $post_data = [ 'region' => 'dublin', 'customer_id' => '1DF2693039' ];
        $request_body = json_encode($post_data);
        $payload = $vagon_api_key.$vagon_request_method.$vagon_request_path.$timestamp.$nonce.$request_body;
        $signature = hash_hmac('sha256', $payload, $vagon_secret);
        $auth = "HMAC $vagon_api_key:$signature:$nonce:$timestamp";
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $auth
        ])->post($vagon_base_url.$vagon_request_path,$post_data);
        
        if($response->successful()){
           return ['status' => true, 'data' => $response->json()];
        }else{
            //return $response->status();
            return ['status' => false, 'errors' => $response->json()];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $project
     * @return \Illuminate\Http\Response
     */
    public function show($project)
    {   
        $projectQuery = Project::where('status',1);    
       
        if(is_numeric($project))
            $projectQuery->where('id',$project);
        else
            $projectQuery->where('slug',$project);
        
        $project = $projectQuery->first();

        if(!$project)
        return response()->json([
            'status'    => false,
            'message'   => 'data errors',
            'errors'    => 'Project not found.',
        ],422);

        $vagonApp = VagonApp::where('project_id',$project->id)->latest()->first();

        if(!$vagonApp)
        return response()->json([
            'status'    => false,
            'message'   => 'data errors',
            'errors'    => 'Vagon app not found.',
        ],422);

        return response()->json([
            'status'  => true, 
            'message' => 'success',
            'data'    => $vagonApp
        ], 200);
    }


    public function getStream(Request $request)
    {
        $validation = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'project_id' => 'required|max:75',
        ]);

        if ($validation->fails()) {
            return response()->json(['status' => false, 'message' => 'Validation errors', 'errors' => $validation->errors()->first()], 422);
        }

        $project_id = $request->input('project_id');
        $projectQuery = Project::where('status',1);    
       
        if(is_numeric($project_id))
            $projectQuery->where('id',$project_id);
        else
            $projectQuery->where('slug',$project_id);
        
        $project = $projectQuery->first();

        if(!$project)
        return response()->json([
            'status'    => false,
            'message'   => 'data errors',
            'errors'    => 'Project not found.',
        ],422);
        
        

        $vagonApp = VagonApp::where('project_id',$project->id)->latest()->first();

        if(!$vagonApp)
        return response()->json([
            'status'    => false,
            'message'   => 'data errors',
            'errors'    => 'Vagon app not found.',
        ],422);

        $user = $request->user();

        //return $this->apiStartStream($request, $user, $project, $vagonApp);
       // return $this->apiAssigningStreamSessionToUser($request, $user, $project, $vagonApp);

       return response()->json([
        'status'  => true, 
        'status_code' => 200,
       // 'vagon_request_path' => $vagon_request_path,
        'message' => 'success',
        'data'    => [
            'project'   => $project,
            'stream'    => $vagonApp
        ]
    ], 200);
            
    }

    public function apiGettingActiveStreams($request, $user, $project, $vagonApp)
    {
        $application_id = $vagonApp->vagon_app_id;
        $vagon_request_method = 'GET';
        $vagon_request_path = '/app-stream-management/v1/applications/'.$application_id.'/streams';
        $timestamp = round(microtime(true) * 1000);
        $nonce = rand(0000, 9999999);
        $post_data = [ 'application_id' => $application_id, 'region' => $vagonApp->region ];
        $request_body = json_encode($post_data);
        $payload = $this->vagon_api_key.$vagon_request_method.$vagon_request_path.$timestamp.$nonce.$request_body;
        $signature = hash_hmac('sha256', $payload, $this->vagon_secret);
        $auth = "HMAC $this->vagon_api_key:$signature:$nonce:$timestamp";
        $finalRequestUrl = $this->vagon_base_url.$vagon_request_path;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $auth
        ])->post($finalRequestUrl,$post_data);
        
        $data = [
            'project_id'        => $project->id, 
            'user_id'           => $user->id, 
            'application_id'    => $application_id, 
            'request_type'      => 'check_streams',
            'request'           => $finalRequestUrl, 
            'response'          => json_encode($response->json()), 
            'response_status'   => $response->status()
        ];
        //return $data;
        VagonApiRequest::create($data);

        if($response->status()===200){
            $res = $response->json();
            $flag = false;
            $activeRow = '';
            if($res['streams']){
                foreach($res['streams'] as $row){
                    if($row['friendly_status'] == 'turning_on'){
                        $flag = true;
                        $activeRow = $row;
                    }
                   
                }
            }

            return response()->json([
                'status'  => true, 
                'status_code' => $response->status(),
                'vagon_request_path' => $vagon_request_path,
                'message' => 'success',
                'data'    => $response->json()
            ], 200);

            //return $this->apiAssigningStreamSessionToUser($request, $user, $project, $vagonApp);

        }else{
          
        }
    }

    public function apiStartStream($request, $user, $project, $vagonApp)
    {

        $application_id = $vagonApp->vagon_app_id;
        $vagon_request_method = 'POST';
       
        $vagon_request_path = '/app-stream-management/v1/applications/'.$application_id.'/streams/create';
    
        $timestamp = round(microtime(true) * 1000);
        $nonce = rand(0000, 9999999);
        $post_data = [ 'application_id' => $application_id, 'region' => $vagonApp->region ];
        $request_body = json_encode($post_data);
        $payload = $this->vagon_api_key.$vagon_request_method.$vagon_request_path.$timestamp.$nonce.$request_body;
        $signature = hash_hmac('sha256', $payload, $this->vagon_secret);
        $auth = "HMAC $this->vagon_api_key:$signature:$nonce:$timestamp";
        $finalRequestUrl = $this->vagon_base_url.$vagon_request_path;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $auth
        ])->post($finalRequestUrl,$post_data);
        
        $data = [
            'project_id'        => $project->id, 
            'user_id'           => $user->id, 
            'application_id'    => $application_id, 
            'request_type'      => 'streams_create',
            'request'           => $finalRequestUrl, 
            'response'          => json_encode($response->json()), 
            'response_status'   => $response->status()
        ];
        //return $data;
        VagonApiRequest::create($data);

        // if($response->status()>=400 && $response->status()<=490){
        //     return response()->json([
        //         'status'        => false, 
        //         'status_code'   => $response->status(),
        //         'vagon_request_path' => $vagon_request_path,
        //         'message'       => 'data conflict in 400',
        //         'errors'          => $response->json()
        //     ], 422);
        //    // return $this->apiAssigningStreamSessionToUser($request, $user, $project, $vagonApp);
        // }else 
        if($response->status()===200){
            // return response()->json([
            //     'status'  => true, 
            //     'status_code' => $response->status(),
            //     'vagon_request_path' => $vagon_request_path,
            //     'message' => 'success',
            //     'data'    => $response->json()
            // ], 200);
            return $this->apiAssigningStreamSessionToUser($request, $user, $project, $vagonApp);

        }else{
           return response()->json([
            'status'        => false,
            'status_code'   => $response->status(),
            'vagon_request_path' => $vagon_request_path,
            'message'       => 'data errors',
            'errors'        => $response->json(),
            ],422);
        }
    }

    public function apiAssigningStreamSessionToUser($request, $user, $project, $vagonApp)
    {
        //sleep(2);
        $application_id = $vagonApp->vagon_app_id;
        $vagon_request_method = 'POST';
      
        $vagon_request_path = '/app-stream-management/v1/applications/'.$application_id.'/streams/assign';
        
        $timestamp = round(microtime(true) * 1000);;
        $nonce = rand(0000, 9999999);
        $post_data = [ 'region' => $vagonApp->region, 'customer_id' => $user->vagon_id ];
        $request_body = json_encode($post_data);
        $payload = $this->vagon_api_key.$vagon_request_method.$vagon_request_path.$timestamp.$nonce.$request_body;
        $signature = hash_hmac('sha256', $payload, $this->vagon_secret);
        $auth = "HMAC $this->vagon_api_key:$signature:$nonce:$timestamp";
        $finalRequestUrl = $this->vagon_base_url.$vagon_request_path;
        
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $auth
        ])->post($finalRequestUrl,$post_data);
        
        $data = [
            'project_id'        => $project->id, 
            'user_id'           => $user->id, 
            'application_id'    => $application_id, 
            'request_type'      => 'streams_assign',
            'request'           => $finalRequestUrl, 
            'response'          => json_encode($response->json()), 
            'response_status'   => $response->status()
        ];
        //return $data;
        VagonApiRequest::create($data);

        if($response->status()===200){
            return response()->json([
                'status'    => true,
                'status_code' => $response->status(),
                'vagon_request_path' => $vagon_request_path,
                'message'   => 'stream data',
                'data' => [
                    'project'   => $project,
                    'stream'    => $response->json()
                ]
            ],200);

        }else if($response->status()===404){
           //Create stream
           return $this->apiStartStream($request, $user, $project, $vagonApp);

        }else{
            return response()->json([
             'status'    => false,
             'status_code' => $response->status(),
             'vagon_request_path' => $vagon_request_path,
             'message'   => 'data errors',
             'errors'    => $response->json(),
             ],422);
         }

    
    }

    public function deleteStream(Request $request, $project_id, $stream_id)
    {
        $project = Project::find($project_id); 
        if(!$project)
        return response()->json([
            'status'    => false,
            'message'   => 'data errors',
            'errors'    => 'Project not found.',
        ],422);
        
        $vagonApp = VagonApp::where('project_id',$project->id)->latest()->first();

        if(!$vagonApp)
        return response()->json([
            'status'    => false,
            'message'   => 'data errors',
            'errors'    => 'Vagon app not found.',
        ],422);

        $user = $request->user();

        $application_id = $vagonApp->vagon_app_id;
      
        $vagon_request_method = 'POST';
        $vagon_request_path = '/app-stream-management/v1/applications/'.$application_id.'/streams/delete';
        $timestamp = round(microtime(true) * 1000);;
        $nonce = rand(0000, 9999999);
        $post_data = [ 'stream_id' => $stream_id ];
        $request_body = json_encode($post_data);
        $payload = $this->vagon_api_key.$vagon_request_method.$vagon_request_path.$timestamp.$nonce.$request_body;
        $signature = hash_hmac('sha256', $payload, $this->vagon_secret);
        $auth = "HMAC $this->vagon_api_key:$signature:$nonce:$timestamp";
        $finalRequestUrl = $this->vagon_base_url.$vagon_request_path;
        
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $auth
        ])->post($finalRequestUrl,$post_data);
        
        $data = [
            'project_id'        => $project->id, 
            'user_id'           => $user->id, 
            'application_id'    => $application_id, 
            'request_type'      => 'streams_delete',
            'request'           => $finalRequestUrl, 
            'response'          => json_encode($response->json()), 
            'response_status'   => $response->status()
        ];
        //return $data;
        VagonApiRequest::create($data);

        if($response->status()===200){
            //
            return response()->json([
                'status'    => true,
                'status_code' => $response->status(),
                'vagon_request_path' => $vagon_request_path,
                'message'   => 'stream data',
                'data' => [
                    'project'   => $project,
                    'stream'    => $response->json()
                ]
            ],200);

        }else{
            return response()->json([
             'status'    => false,
             'status_code' => $response->status(),
             'vagon_request_path' => $vagon_request_path,
             'message'   => 'data errors',
             'errors'    => $response->json(),
             ],422);
        }
    
    }

    public function checkAuth(Request $request)
    {
        $token = str_replace('Bearer ', '', $request->header('Authorization'));
        $user = $request->user();

        $data = ['token' => $token, 'user_id' => $user->id ];
        return response()->json([
               'status'  => true,
               'message' => 'auth success',
               'data' => $data
        ],200);

   	}

   	public function storeLogs(Request $request)
    {
       
        $user = $request->user();

        $inputs = $request->all();
        
        $data = [
         'inputs' => $inputs,
         'ip_address' => $request->ip(), 
         'user_agent' => $request->header('User-Agent'),
         'created_at' => \Carbon\Carbon::now()
        ];
        Log::debug('storeLogs',['user' => ['id' => $user->id,'email' => $user->email],'data' => $data]);

        return response()->json([
               'status'  => true,
               'message' => 'data vagon stream app log',
               'data' => $data,

        ],200);

   	}
   
}
