<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(['email' => 'admin@example.test'], [
            'name'      => 'Demo Admin',
            'password'  => Hash::make('password'),
            'role'      => 'admin',
            'is_active' => true,
        ]);

        User::updateOrCreate(['email' => 'lpu@example.test'], [
            'name'      => 'Demo LPU',
            'password'  => Hash::make('password'),
            'role'      => 'lpu',
            'is_active' => true,
        ]);
    }
}