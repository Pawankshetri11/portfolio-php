<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'email' => 'pawankshetri11@gmail.com',
        ], [
            'name' => 'Admin',
            'password' => Hash::make('Pawan@1@'),
            'email_verified_at' => now(),
        ]);
    }
}
