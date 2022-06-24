<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users=[
        [
            'id' => 1,
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => NULL,
            'password' => Hash::make('admin123'),
            'level' => 1,
        ],
    ];
    User::insert($users);
    }
}
