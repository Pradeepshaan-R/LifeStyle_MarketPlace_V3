<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class UserExtraTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = date('Y-m-d H:i:s');

        //1
        DB::table('user_extras')->insert([
            'id' => 1,
            'phone' => '94112345678',
            'user_id' => 1,
            'tenant_id' => '1',
        ]);

        //2
        DB::table('user_extras')->insert([
            'id' => 2,
            'phone' => '94112345678',
            'user_id' => 2,
            'tenant_id' => '1',
        ]);

        //3
        DB::table('user_extras')->insert([
            'id' => 3,
            'phone' => '94112345678',
            'user_id' => 3,
            'tenant_id' => '1',
        ]);

        //4
        DB::table('user_extras')->insert([
            'id' => 4,
            'phone' => '94112345678',
            'user_id' => 4,
            'tenant_id' => '1',
        ]);

        //5
        DB::table('user_extras')->insert([
            'id' => 5,
            'phone' => '94112345678',
            'user_id' => 5,
            'tenant_id' => '1',
        ]);

        //6
        DB::table('user_extras')->insert([
            'id' => 6,
            'phone' => '94112345678',
            'user_id' => 6,
            'tenant_id' => '1',
        ]);
    }
}