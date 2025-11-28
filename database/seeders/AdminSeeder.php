<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'System Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'phone' => '777777777',
            'location' => 'المكلا',
            'role' => 'admin',
            'bio' => null,
            'image' => null,
            'rating_avg' => 0,
        ]);
    }
}
