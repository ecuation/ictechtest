<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin user',
            'email' => 'admin@example.test',
            'password' => Hash::make('secret'),
        ]);

        $admin->assignRole('ADMIN');

        $responsible = User::create([
            'name' => 'Responsible user',
            'email' => 'responsible@example.test',
            'password' => Hash::make('secret'),
        ]);

        $responsible->assignRole('RESPONSIBLE');

        $assigned = User::create([
            'name' => 'Assigned user',
            'email' => 'assigned@example.test',
            'password' => Hash::make('secret'),
        ]);

        $assigned->assignRole('ASSIGNED');
    }
}
