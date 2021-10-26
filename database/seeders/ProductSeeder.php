<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i=1; $i < 10; $i++) {
            DB::table('products')->insert([
                'name'          => $faker->text(20),
                'quantity'      => rand(100, 500),
                'unit'          => 'Kg',
                'purchaseprice' => rand(230, 260),
                'category_id'   => rand(1, 9),
                'added_by'      => 1,
                'note'          => $faker->text(100),
                'status'        => 'Active',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
