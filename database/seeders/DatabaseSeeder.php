<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('settings')->insert([
            'shopname' 	=> 'Demo Shop',
            'phone' 	=> '123456789',
            'email' 	=> 'admin@gmail.com',
            'logotext' 	=> 'Demo',
            'copyright' => 'Copyright © 2020. All Rights Reserved.',
            'address' 	=> 'Swedish Area, Kaptai, Rangamati.',
        ]);

        DB::table('users')->insert([
            'firstname' 	=> 'Md Dalwar',
            'lastname' 		=> 'Hossan',
            'email' 		=> 'admin@gmail.com',
            'designation' 	=> 'Super Admin',
            'password' 		=> Hash::make('password'),
        ]);
    }
}
