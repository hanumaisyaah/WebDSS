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
            [
                'id' => 2,
                'name' => 'Adi',
                'email' => 'adi@gmail.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('12345678'),
                'level' => 2,
            ],
            [
                'id' => 3,
                'name' => 'Putu',
                'email' => 'putu@gmail.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('12345678'),
                'level' => 2,
            ],
            [
                'id' => 4,
                'name' => 'Wayan',
                'email' => 'wayan@gmail.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('12345678'),
                'level' => 2,
            ],
            [
                'id' => 5,
                'name' => 'Ida',
                'email' => 'ida@gmail.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('12345678'),
                'level' => 2,
            ],
            [
                'id' => 6,
                'name' => 'Agus',
                'email' => 'agus@gmail.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('12345678'),
                'level' => 2,
            ],
            [
                'id' => 7,
                'name' => 'Doni',
                'email' => 'doni@gmail.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('12345678'),
                'level' => 2,
            ],
            [
                'id' => 8,
                'name' => 'Meika',
                'email' => 'meika@gmail.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('12345678'),
                'level' => 2,
            ],
            [
                'id' => 9,
                'name' => 'Deka',
                'email' => 'deka@gmail.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('12345678'),
                'level' => 2,
            ],
            [
                'id' => 10,
                'name' => 'Amla',
                'email' => 'amla@gmail.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('12345678'),
                'level' => 2,
            ],
            [
                'id' => 11,
                'name' => 'Rizky',
                'email' => 'rizky@gmail.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('12345678'),
                'level' => 2,
            ],
            [
                'id' => 12,
                'name' => 'kadek',
                'email' => 'kadek@gmail.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('12345678'),
                'level' => 2,
            ],
            [
                'id' => 13,
                'name' => 'Suci',
                'email' => 'suci@gmail.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('12345678'),
                'level' => 2,
            ],
            [
                'id' => 14,
                'name' => 'Dickyu',
                'email' => 'dickyu@gmail.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('12345678'),
                'level' => 2,
            ],
            [
                'id' => 15,
                'name' => 'Ngurah',
                'email' => 'ngurah@gmail.com',
                'email_verified_at' => NULL,
                'password' => Hash::make('12345678'),
                'level' => 2,
            ],
    ];
    User::insert($users);
    }
}
