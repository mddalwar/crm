<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i=1; $i < 21; $i++) {
            DB::table('expenses')->insert([
                'title'         => $faker->text(30),
                'amount'        => rand(100, 500),
                'consumer'      => $faker->name,
                'reference'     => 'Voucher No-' . rand(1, 100),
                'note'          => $faker->text(100),
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
