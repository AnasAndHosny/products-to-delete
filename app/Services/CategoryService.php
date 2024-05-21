<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function index()
    {
        $category = Category::paginate();
        $message = 'Categories list retrieved successfully.';
        $code = 200;
        return ['category' => $category, 'message' => $message, 'code' => $code];
    }

    public function store($request): array
    {
        $image = ImageService::store($request);
        $category = Category::query()->create([
            'image' => $image,
            'name_ar' => $request['name_ar'],
            'name_en' => $request['name_en']
        ]);

        $message = 'Category created successfully.';
        $code = 201;
        return ['category' => $category, 'message' => $message, 'code' => $code];
    }

    public function show(Category $category): array
    {
        $message = 'Category retrieved successfully.';
        $code = 200;
        return ['category' => $category, 'message' => $message, 'code' => $code];
    }

    public function update($request, Category $category): array
    {
        $image = ImageService::update($request, $category);
        $category->update([
            'image' => $image,
            'name_ar' => $request['name_ar'] ?? $category['name_ar'],
            'name_en' => $request['name_en'] ?? $category['name_en']
        ]);
        $category = Category::query()->find($category->id);

        $message = 'Category updated successfully.';
        $code = 200;
        return ['category' => $category, 'message' => $message, 'code' => $code];
    }

    public function destroy(Category $category): array
    {
        //
    }
}
