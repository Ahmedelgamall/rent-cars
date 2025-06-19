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
            ['title:ar' => 'سيارات فخمة'],
            ['title:ar' => 'سيارات رجال اعمال'],
            ['title:ar' => 'فان']
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
