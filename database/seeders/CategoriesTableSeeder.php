<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['title:ar' => 'هيونداى'],
            ['title:ar' => 'مرسيدس'],
            ['title:ar' => 'فيات'],
            ['title:ar' => 'شيرى'],
            ['title:ar' => 'هوندا']
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
