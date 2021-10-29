<?php

namespace Database\Seeders\Auth;

use App\Domains\Auth\Models\User;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

/**
 * Class UserTableSeeder.
 */
class UserSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Add the master administrator, user id of 1
        User::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'Super Admin',
            'email' => 'azmeer.sc@gmail.com',
            'password' => 'secret',
            'email_verified_at' => now(),
            'active' => true,
        ]);

        //id=2
        User::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'LMS Admin',
            'email' => 'lms_admin@test.com',
            'password' => 'secret',
            'email_verified_at' => now(),
            'active' => true,
        ]);

        //id=3
        User::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'Tenant1 Admin',
            'email' => 'tenant1_admin@test.com',
            'password' => 'secret',
            'email_verified_at' => now(),
            'active' => true,
        ]);

        //id=4
        User::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'Manager1',
            'email' => 'manager1@test.com',
            'password' => 'secret',
            'email_verified_at' => now(),
            'active' => true,
        ]);

        //id=5
        User::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'Staff1',
            'email' => 'staff1@test.com',
            'password' => 'secret',
            'email_verified_at' => now(),
            'active' => true,
        ]);

        //id=6
        User::create([
            'type' => User::TYPE_USER,
            'name' => 'Client1',
            'email' => 'client1@user.com',
            'password' => 'secret',
            'email_verified_at' => now(),
            'active' => true,
        ]);

        $this->enableForeignKeys();
    }
}
