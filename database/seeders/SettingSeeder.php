<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            'shopname'  => 'Demo Shop',
            'phone'     => '12345678',
            'email'     => 'admin@gmail.com',
            'logotext'  => 'Demo',
            'copyright' => 'Copyright © 2020. All Rights Reserved.',
            'address'   => 'Swedish Area, Kaptai, Rangamati.',
            'currency'  => 'Taka'
        ];

        Setting::create([
            'setting_key'   => 'shop_info',
            'setting_value' => json_encode($settings)
        ]);
    }
}
