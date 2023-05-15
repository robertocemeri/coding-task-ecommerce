<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Category::factory(10)->create();

        \App\Models\Category::create([
            'name' => 'Books',
        ]);
        \App\Models\Category::create([
            'name' => 'Clothes',
        ]);
        \App\Models\Category::create([
            'name' => 'Devices',
        ]);
        \App\Models\User::create([
            'name' => 'Roberto Cemeri',
            'email' => 'robertocemeri29@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('roberto1'),
        ]);
        \App\Models\User::create([
            'name' => 'Roberto Cemeri',
            'email' => 'robertocemeri@gmail.com',
            'role' => 'user',
            'password' => Hash::make('roberto1'),
        ]);
    }
}
