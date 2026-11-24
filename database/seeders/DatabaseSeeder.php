<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
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

        $catJaringan = Category::updateOrCreate(
            ['name' => 'Perangkat Jaringan'],
            ['description' => 'Router, switch, access point, dan kabel LAN']
        );

        $catMultimedia = Category::updateOrCreate(
            ['name' => 'Multimedia'],
            ['description' => 'Proyektor, kabel HDMI, dan lain sebagainya']
        );

        $catPraktikum = Category::updateOrCreate(
            ['name' => 'Alat Praktikum'],
            ['description' => 'hardware (contoh: mouse, keyboard, dll)']
        );

        Item::updateOrCreate(
            ['code' => 'LAB-NET-001'],
            [
                'category_id' => $catJaringan->id,
                'name' => 'MikroTik',
                'location' => 'Lemari A, Lab Jaringan',
                'condition' => 'Baik',
                'stock' => 6,
            ]
        );

        Item::updateOrCreate(
            ['code' => 'LAB-NET-002'],
            [
                'category_id' => $catJaringan->id,
                'name' => 'Kabel LAN Cat6 5 Meter',
                'location' => 'Rak Kabel, Lab Jaringan',
                'condition' => 'Baik',
                'stock' => 12,
            ]
        );

        Item::updateOrCreate(
            ['code' => 'LAB-MUL-001'],
            [
                'category_id' => $catMultimedia->id,
                'name' => 'Proyektor Epson',
                'location' => 'Lemari B, Ruang Asisten',
                'condition' => 'Baik',
                'stock' => 2,
            ]
        );

        Item::updateOrCreate(
            ['code' => 'LAB-PRK-001'],
            [
                'category_id' => $catPraktikum->id,
                'name' => 'Keyboard Mechanical Lab',
                'location' => 'Meja Teknisi, Lab Dasar',
                'condition' => 'Rusak Ringan',
                'stock' => 1,
            ]
        );
    }
}
