<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'irham@simalab.test'],
            [
                'name' => 'Irham Rizqan Zakiy',
                'password' => Hash::make('password123'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'rashad@simalab.test'],
            [
                'name' => 'Rashad Shaquille Taofik',
                'password' => Hash::make('password123'),
            ]
        );

        Category::updateOrCreate(
            ['name' => 'Perangkat Jaringan'],
            ['description' => 'Router, switch, access point, dan kabel LAN']
        );

        Category::updateOrCreate(
            ['name' => 'Multimedia'],
            ['description' => 'Proyektor, kabel HDMI, dan lain sebagainya']
        );

        Category::updateOrCreate(
            ['name' => 'Alat Praktikum'],
            ['description' => 'hardware (contoh: mouse, keyboard, dll)']
        );
    }
}
