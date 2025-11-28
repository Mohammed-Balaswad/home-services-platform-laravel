<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::insert([
            [
                'name' => 'كهرباء',
                'icon' => 'categories/electric.png', 
            ],
            [
                'name' => 'سباكة',
                'icon' => 'categories/plumbing.png',
            ],
            [
                'name' => 'نجارة',
                'icon' => 'categories/carpentry.png',
            ],
            [
                'name' => 'تنظيف',
                'icon' => 'categories/cleaning.png',
            ],
        ]);
    }
}