<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users =  [
            [
                'name' => 'Waed Habash',
                'email' => 'waed@oginvestors.net',
                'password' => Hash::make('12345678'),
                'phone' => '905411013195',
                'orgzit_customer_record_id' => 'es23kf2ry4',
            ],
            [
                'name' => 'Recep Tokay',
                'email' => 'info@beyaznoktainsaat.com',
                'password' => Hash::make('12345678'),
                'phone' => '905327997134',
                'orgzit_customer_record_id' => 'vei6rnxx21',                
            ],
            [
                'name' => 'Umut Oker',
                'email' => 'umut@megacity.com.tr',
                'password' => Hash::make('12345678'),
                'phone' => '905412453447',
                'orgzit_customer_record_id' => 'qt21btv5r1',
            ],
            [
                'name' => 'Ghulam sediqi',
                'email' => 'ghulamsediqsediqi123@gmail.com',
                'password' => Hash::make('12345678'),
                'phone' => '93796464920',
                'orgzit_customer_record_id' => 'x229hvq2dz',
            ],
            [
                'name' => 'Othmane bannany',
                'email' => 'othmane.bannany1@outlook.com',
                'password' => Hash::make('12345678'),
                'phone' => '905527841553',
                'orgzit_customer_record_id' => 'p5uty5w6c8',
            ],
            [
                'name' => 'Hussein Alhamou',
                'email' => 'hsn461211@gmail.com',
                'password' => Hash::make('12345678'),
                'phone' => '9613025586',
                'orgzit_customer_record_id' => 'u0coc47pvi',
            ]
          ];

        User::insert($users);
        
    }
}
