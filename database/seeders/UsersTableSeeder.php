<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'John Doe',
                'email' => 'johndoe@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Jane Doe',
                'email' => 'janedoe@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Mike Smith',
                'email' => 'mikesmith@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Anna Johnson',
                'email' => 'annajohnson@example.com',
                'password' => Hash::make('password123'),
            ],
        ]);
    }
}
