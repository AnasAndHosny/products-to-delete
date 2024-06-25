<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'category' => [
                    'name_ar' => '',
                    'name_en' => ''
                ],
                'subcategories' => [
                    [
                        'image' => '',
                        'name_ar' => '',
                        'name_en' => ''
                    ],
                    [
                        'image' => '',
                        'name_ar' => '',
                        'name_en' => ''
                    ],
                    [
                        'image' => '',
                        'name_ar' => '',
                        'name_en' => ''
                    ],
                ]
            ],
        ];
        foreach ($categories as $category) {
            $category = Category::create($category['category']);
            foreach ($category['subcategories'] as $subCategory) {
                $category->subCategories()->create($subCategory);
            }
        }
    }
}
