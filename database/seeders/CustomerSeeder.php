<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i=1; $i < 50; $i++) {
            DB::table('customers')->insert([
                'name'          => $faker->name,
                'email'         => $faker->email,
                'phone'         => $faker->phoneNumber,
                'address'       => $faker->address,
                'added_by'      => 1,
                'status'        => 'Active',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
