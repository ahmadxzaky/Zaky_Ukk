<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Book;

class DatabaseSeeder extends Seeder {
    public function run() {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Officer User',
            'email' => 'officer@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'officer'
        ]);

        User::create([
            'name' => 'Visitor User',
            'email' => 'visitor@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'visitor'
        ]);
    }
}
