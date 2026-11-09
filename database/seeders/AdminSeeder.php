<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'admin@bluehour.com'],
            [
                'name'     => 'Administrator',
                'email'    => 'admin@bluehour.com',
                'password' => Hash::make('Admin@12345'),
            ]
        );

        if ($user->role !== 'admin') {
            $user->role = 'admin';
            $user->save();
        }
    }
}