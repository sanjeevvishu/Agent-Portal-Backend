<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class DemoUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //php artisan db:seed --class=DemoUsersTableSeeder


        $users = [
            [
              "firstName" => "Saurabh",
              "lastName" => "Khichi",
              "email" => "saurabh@cubedots.com"
            ],
            [
              "firstName" => "Sushil",
              "lastName" => "Agrawal",
              "email" => "sushil.agrawal@cubedots.com"
            ],
            [
              "firstName" => "Abu",
              "lastName" => "Sarosh",
              "email" => "abu@cubedots.com"
            ],
            [
              "firstName" => "Kartik",
              "lastName" => "Marathe",
              "email" => "kartik.marathe@cubedots.com"
            ],
            [
              "firstName" => "Aamir",
              "lastName" => "Siddiqui",
              "email" => "aamir@cubedots.com"
            ],
            [
              "firstName" => "Aishwarya",
              "lastName" => "Tarlekar",
              "email" => "aishwarya.tarlekar@cubedots.com"
            ],
            [
              "firstName" => "Manish",
              "lastName" => "Patel",
              "email" => "manish.patel@cubedots.com"
            ],
            [
              "firstName" => "Meenal",
              "lastName" => "Sankla",
              "email" => "Meenal.Sankla@cubedots.com"
            ],
            [
              "firstName" => "Kamlesh",
              "lastName" => "Maina",
              "email" => "Kamlesh.Maina@cubedots.com"
            ],
            [
              "firstName" => "Yash Kumar",
              "lastName" => "Sharma",
              "email" => "yash@cubedots.com"
            ],
            [
              "firstName" => "Aamir",
              "lastName" => "Azri",
              "email" => "Aamir.Azri@cubedots.com"
            ],
            [
              "firstName" => "Gaurav",
              "lastName" => "Paliwal",
              "email" => "Gaurav.Paliwal@cubedots.com"
            ],
            [
              "firstName" => "Aditya",
              "lastName" => "Vyas",
              "email" => "Aditya.Vyas@cubedots.com"
            ],
            [
              "firstName" => "Aaditya",
              "lastName" => "Baheti",
              "email" => "Aaditya.Baheti@cubedots.com"
            ],
            [
              "firstName" => "Neetu",
              "lastName" => "Meena",
              "email" => "Neetu.Meena@cubedots.com"
            ],
            [
              "firstName" => "Shubham",
              "lastName" => "Bisht",
              "email" => "shubham.bisht@cubedots.com"
            ],
            [
              "firstName" => "Mehvish",
              "lastName" => "Shaikh",
              "email" => "mehvish@cubedots.com"
            ],
            [
              "firstName" => "Garima",
              "lastName" => "Lande",
              "email" => "garima.lande@cubedots.com"
            ],
            [
              "firstName" => "Aman",
              "lastName" => "Saxena",
              "email" => "itadmin@cubedots.com"
            ],
            [
              "firstName" => "Mukul",
              "lastName" => "Karlkar",
              "email" => "Mukul.Karlkar@cubedots.com"
            ],
            [
              "firstName" => "Anupriya",
              "lastName" => "Wadhera",
              "email" => "anupriya@cubedots.com"
            ],
            [
              "firstName" => "Piyush",
              "lastName" => "Dhariwal",
              "email" => "piyush.dhariwal@cubedots.com"
            ],
            [
              "firstName" => "Aniket",
              "lastName" => "Bhargav",
              "email" => "Aniket.Bhargav@cubedots.com"
            ],
            [
              "firstName" => "Anand",
              "lastName" => "Dixit",
              "email" => "anand@cubedots.com"
            ],
            [
              "firstName" => "Mustafa",
              "lastName" => "Hussain",
              "email" => "mustafa.hussain@cubedots.com"
            ],
            [
              "firstName" => "Harshal",
              "lastName" => "Pure",
              "email" => "Harshal.Pure@cubedots.com"
            ],
            [
              "firstName" => "Amol",
              "lastName" => "Gawali",
              "email" => "amol.gawali@cubedots.com"
            ],
            [
              "firstName" => "Aakash",
              "lastName" => "Solanki",
              "email" => "aakash@cubedots.com"
            ],
            [
              "firstName" => "Ali",
              "lastName" => "Asgher",
              "email" => "Ali.Asgher@cubedots.com"
            ],
            [
              "firstName" => "Shahrukh",
              "lastName" => "Ansari",
              "email" => "Shahrukh.Ansari@cubedots.com"
            ],
            [
              "firstName" => "Ashish",
              "lastName" => "Kushwah",
              "email" => "Ashish.Kushwah@cubedots.com"
            ],
            [
              "firstName" => "Chamandeep",
              "lastName" => "Singh",
              "email" => "Chamandeep.Singh@cubedots.com"
            ],
            [
              "firstName" => "Umesh",
              "lastName" => "Sahu",
              "email" => "umesh@cubedots.com"
            ],
            [
              "firstName" => "Aditya",
              "lastName" => "Nandane",
              "email" => "aditya@cubedots.com"
            ],
            [
              "firstName" => "Kashif",
              "lastName" => "Khan",
              "email" => "Kashif.Khan@cubedots.com"
            ],
            [
              "firstName" => "Girijashankar",
              "lastName" => "Sharma",
              "email" => "Girjashankar@cubedots.com"
            ],
            [
              "firstName" => "Ruchi",
              "lastName" => "Dholpure",
              "email" => "recruitment@cubedots.com"
            ]
        ];

        foreach($users as $row){
           $user =  User::where('email',$row['email'])->first();
           if(!$user){
               $data = [
                'name' => $row['firstName'].' '.$row['lastName'],
                'email' => $row['email'],
                'password' => Hash::make('12345678'),
               ];
                User::insert($data);
           }

        }
        
    }
}
