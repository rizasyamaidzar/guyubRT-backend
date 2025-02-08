<?php

namespace Database\Seeders;

use App\Models\Cash;
use App\Models\Category;
use App\Models\Home;
use App\Models\User;
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
        // User::factory(10)->create();
        // Category Seeder
        Category::factory()->create([
            'name' => 'Iuran Satpam',
            'amount' => 100000
        ]);
        Category::factory()->create([
            'name' => 'Kebersihan',
            'amount' => 15000
        ]);
        Home::factory()->create([
            'number' => '32 A',
            'type' => 'Tetap',
            'status' => 'Dihuni'
        ]);
        Home::factory()->create([
            'number' => '10 B',
            'type' => 'Tetap',
            'status' => 'Dihuni'
        ]);
        User::factory()->create([
            'name' => 'Pak RT',
            'foto' => 'contoh.png',
            'number_phone' => '081238843834',
            'status' => 'Kontrak',
            'pernikahan' => true,
            'home_id' => 1,
        ]);
        User::factory()->create([
            'name' => 'Januar Suherman',
            'foto' => 'contoh.png',
            'number_phone' => '081238843834',
            'status' => 'Kontrak',
            'pernikahan' => true,
            'home_id' => 2,
        ]);
        Cash::factory()->create([
            'amount' => 0
        ]);
    }
}
