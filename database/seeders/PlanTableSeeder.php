<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class PlanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = date('Y-m-d H:i:s');
        /**
         * 1
         * Suitable for De Saram. Please check the 'no_of_levels' => '-1' before showing this on drop-downs
         * $plan_list = Plan::select('id', 'name')->where('no_of_levels', '<>', '-1')->get();
         */
        DB::table('plans')->insert([
            'name' => 'Unlimited',
            'no_of_levels' => '-1',
            'monthly_rate' => '0',
            'annual_rate' => '0',
            'min_users' => '1',
            'max_users' => '1000',
        ]);
        //2
        DB::table('plans')->insert([
            'name' => 'Ultra Lite',
            'no_of_levels' => '0',
            'monthly_rate' => '490',
            'annual_rate' => '450',
            'min_users' => '1',
            'max_users' => '1',
        ]);
        //3
        DB::table('plans')->insert([
            'name' => 'Lite',
            'no_of_levels' => '1',
            'monthly_rate' => '850',
            'annual_rate' => '750',
            'min_users' => '2',
            'max_users' => '10',
        ]);
        //4
        DB::table('plans')->insert([
            'name' => 'Essentials',
            'no_of_levels' => '2',
            'monthly_rate' => '1050',
            'annual_rate' => '950',
            'min_users' => '2',
            'max_users' => '1000',
        ]);
        //5
        DB::table('plans')->insert([
            'name' => 'Standard',
            'no_of_levels' => '3',
            'monthly_rate' => '1250',
            'annual_rate' => '1150',
            'min_users' => '2',
            'max_users' => '1000',
        ]);

    }
}