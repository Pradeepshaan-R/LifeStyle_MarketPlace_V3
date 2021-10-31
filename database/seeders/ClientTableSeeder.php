<?php

namespace Database\Seeders;

use DB;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * $faker->jobTitle
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 25) as $index) {
            DB::table('clients')->insert([
                'type' => $faker->randomElement(['Individual', 'Company']),
                'status' => "Active",
                'company_name' => $faker->company,
                'company_email' => $faker->email,
                'company_phone' => $faker->ean13,
                'company_address' => $faker->address,
                'company_city' => $faker->city,
                'company_legal_type' => $faker->randomElement(['Sole', 'Pvt', 'Ltd', 'Plc', 'Gov']),
                'country_id' => 211,
                'tenant_id' => 1,
                'user_id' => 6,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
