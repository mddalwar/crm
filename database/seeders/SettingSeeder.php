<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'setting_key' 	 => 'shopname',
                'setting_value'  => 'Demo Shop',
            ],

            [
                'setting_key'       => 'phone',
                'setting_value'     => '123456789',
            ],

            [
                'setting_key'       => 'email',
                'setting_value'     => 'settings@gmail.com',
            ],
            
            [
                'setting_key'       => 'logotext',
                'setting_value'     => 'Demo',
            ],
            [
                'setting_key'       => 'copyright',
                'setting_value'     => 'Copyright © 2020. All Rights Reserved.',
            ],
            [
                'setting_key'       => 'address',
                'setting_value'     => 'Swedish Area, Kaptai, Rangamati.',
            ],
            [
                'setting_key'       => 'currency',
                'setting_value'     => 'Taka',
            ],
            
        ]);
    }
}
