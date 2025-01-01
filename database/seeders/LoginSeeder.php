<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LoginSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'username' => 'admin',
            'password' => Hash::make('admin123')
        ]);
    }
}