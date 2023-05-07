<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name' => 'One Hospital Admin',
            'code' => 'FIRST',
            'role' => 'admin',
            'email' => 'one.hospital.admin@gmail.com',
            'password' => Hash::make('password'),
            'details' => json_encode([
                'firstname' => 'admin',
                'middlename' => 'admin',
                'lastname' => 'admin',
                'suffix' => 'admin',
                'contact_number' => 'admin',
                'age' => 0,
                'address' => 'admin',
            ])
        ]);
    }
}
