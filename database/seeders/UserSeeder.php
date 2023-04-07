<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'role' => 'Admin',
            'status' => 'Approved',
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'skype' => 'fdsafasdfasdf',
            'country' => 1,
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);
        // Bulk user creation using factory advertiser
        User::factory()->count(1010)->create([
            'role' => 'Advertiser',
            'status' => 'Approved',
        ]);
        // Manager creation using factory manager

        User::factory()->count(2020)->create([
            'role' => 'Manager',
            'status' => 'Approved',
        ]);
        User::factory()->count(2020)->create([
            'role' => 'Affiliate',
            'status' => 'Approved',
            'manager_id' => 1,
        ]);
    }
}
