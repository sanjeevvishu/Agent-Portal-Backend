<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Mail;


class AgentsUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //php artisan db:seed --class=AgentsUsersTableSeeder

        //$path = storage_path('app/agents_csvjson.json');
        //$path = storage_path('app/newFileAgentsWithEmail.json');
        //$path = storage_path('app/INTLRelationshipAgents26-04-2022-27apr.json');
        $path = storage_path('app/ActiveAgentsSecondList_27APR.json');

        $jsonContent = file_get_contents($path);
        $users = json_decode($jsonContent,true);
      
        if($users){
            foreach($users as $row){
                $user =  User::where('email',$row['email'])->first();
                if(!$user){
                    $randPassword = Str::random(8);
                    $data = [
                     'name' => ucfirst($row['fullName']),
                     'email' => $row['email'],
                     'phone' => $row['phone'],
                     'orgzit_id' => $row['orgzit_id'],
                     'orgzit_customer_record_id' => $row['orgzit_customer_record_id'],
                     'company_name' => $row['company'] ? $row['company'] : null,
                     'password' => Hash::make( $randPassword),
                    ];
                    //dd( $randPassword,$data);
                    $user = User::create($data);
                   // print_r($data);
                    /*Mail::send('portal_email.newPasswordForPortal', ['user' => $user, 'password' => $randPassword], function($message) use($user){
                        $message->to($user->email);
                        //$message->bcc('sanjeev@cubedots.com');
                        $message->subject('New Password for portal');
                    });*/
                }else{
                    $data = [
                        'name' => ucfirst($row['fullName']),
                        'phone' => $row['phone'],
                        'orgzit_id' => $row['orgzit_id'],
                        'orgzit_customer_record_id' => $row['orgzit_customer_record_id'],
                        'company_name' => $row['company'] ? $row['company'] : null,
                    ];
                     User::where('id',$user->id)->update($data);
                }
     
             }
        }
        
    }
}
// dd($users[0]);
// $users = [$users[0]];
// dd($users);

/*$users = [
[
  "orgzit_customer_record_id" =>  "kmx9fef4ro",
  "orgzit_id" =>  23328,
  "fullName" =>  "Atul Sethiya",
  "phone" =>  "+447770471549",
  "company" =>  "Cubedots",
  "email" =>  "atul@cubedots.com"
],[
  "orgzit_customer_record_id" =>  "rdtu0qbzay",
  "orgzit_id" =>  23329,
  "fullName" =>  "Avijit Bhaya",
  "phone" =>  "+905453362121",
  "company" =>  "Cubedots",
  "email" =>  "avijit@cubedots.com"
],
[
    "orgzit_customer_record_id" =>  "kqhc2bfkac",
    "orgzit_id" =>  23387,
    "fullName" =>  "Rajiv Dubey",
    "phone" =>  "+447590216169",
    "company" =>  "Cubedots",
    "email" =>  "rajiv.dubey@cubedots.com"
  ]
];*/