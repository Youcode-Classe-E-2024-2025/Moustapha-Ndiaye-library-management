<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {   
        // delete datas test before insersion
        User::truncate();

        // Number of admin users
        User::factory()->count(2)->create([
            'role' => 'admin'
        ]);

        // Number of regular users
        User::factory()->count(10)->create([
            'role' => 'user'
        ]);

        // Creating specific users
        User::create([
            'fullname' => 'Moustapha',
            'email' => 'exemple@admin.com',
            'password' => bcrypt('admin'),
            'role' => 'admin'
        ]);

        User::create([
            'fullname' => 'User Example',
            'email' => 'user@example.com',
            'password' => bcrypt('user'),
            'role' => 'user'
        ]);

        
    }
}
