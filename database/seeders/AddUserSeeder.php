<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class AddUserSeeder extends Seeder
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
                    'id' => 16,
                    'name' => 'Tisna',
                    'email' => 'tisna@gmail.com',
                    'email_verified_at' => NULL,
                    'password' => Hash::make('12345678'),
                    'level' => 2,
                ],
                [
                    'id' => 17,
                    'name' => 'Nurul',
                    'email' => 'nurul@gmail.com',
                    'email_verified_at' => NULL,
                    'password' => Hash::make('12345678'),
                    'level' => 2,
                ],
                [
                    'id' => 18,
                    'name' => 'Fitri',
                    'email' => 'fitri@gmail.com',
                    'email_verified_at' => NULL,
                    'password' => Hash::make('12345678'),
                    'level' => 2,
                ],
                [
                    'id' => 19,
                    'name' => 'Dewa',
                    'email' => 'dewa@gmail.com',
                    'email_verified_at' => NULL,
                    'password' => Hash::make('12345678'),
                    'level' => 2,
                ],
                [
                    'id' => 20,
                    'name' => 'Rahmat',
                    'email' => 'rahmat@gmail.com',
                    'email_verified_at' => NULL,
                    'password' => Hash::make('12345678'),
                    'level' => 2,
                ],
                [
                    'id' => 21,
                    'name' => 'Akbar',
                    'email' => 'akbar@gmail.com',
                    'email_verified_at' => NULL,
                    'password' => Hash::make('12345678'),
                    'level' => 2,
                ],
                [
                    'id' => 22,
                    'name' => 'Made',
                    'email' => 'made@gmail.com',
                    'email_verified_at' => NULL,
                    'password' => Hash::make('12345678'),
                    'level' => 2,
                ],
                [
                    'id' => 23,
                    'name' => 'Putra',
                    'email' => 'putra@gmail.com',
                    'email_verified_at' => NULL,
                    'password' => Hash::make('12345678'),
                    'level' => 2,
                ],
                [
                    'id' => 24,
                    'name' => 'Budi',
                    'email' => 'budi@gmail.com',
                    'email_verified_at' => NULL,
                    'password' => Hash::make('12345678'),
                    'level' => 2,
                ],
                [
                    'id' => 25,
                    'name' => 'Nova',
                    'email' => 'nova@gmail.com',
                    'email_verified_at' => NULL,
                    'password' => Hash::make('12345678'),
                    'level' => 2,
                ],
                [
                    'id' => 26,
                    'name' => 'Bagus',
                    'email' => 'bagus@gmail.com',
                    'email_verified_at' => NULL,
                    'password' => Hash::make('12345678'),
                    'level' => 2,
                ],
        ];
        User::insert($users);
        }
    }
