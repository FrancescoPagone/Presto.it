<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public $categories = [
        'modaUomo',
        'modaDonna',
        'elettronica',
        'casaArredamento',
        'automobili',
        'bellezza',
        'sporteFitness',
        'bambiniNeonati',
        'alimentari',
        'salute'
    ];

    public function run(): void
    {
        foreach ($this->categories as $category)
            Category::create([
                'category' => $category
            ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'is_revisor' => true
        ]);
    }
}
