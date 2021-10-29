<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class TenantTableSeeder extends Seeder
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
        DB::table('tenants')->insert([
            'tenant_name' => 'Sample Tenant',
            'address' => 'Test road',
            'city' => 'test city',
            'email' => 'test@sharecolombo.com',
            'phone' => '94112345678',
            'plan_id' => '1',
            'started_date' => $today,
            'expiry_date' => "2025-12-31 12:00:00",
            'created_at' => $today,
            'updated_at' => $today,
        ]);

        //2
        DB::table('tenants')->insert([
            'tenant_name' => 'Desaram',
            'address' => 'Test road',
            'city' => 'test city',
            'email' => 'test@desaram.com',
            'phone' => '94112345678',
            'plan_id' => '1',
            'started_date' => $today,
            'expiry_date' => "2025-12-31 12:00:00",
            'created_at' => $today,
            'updated_at' => $today,
        ]);
    }
}