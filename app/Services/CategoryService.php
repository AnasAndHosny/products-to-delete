<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function index()
    {
        $category = Category::paginate();
        $message = __('messages.index_success', ['class' => __('Categories')]);
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

        $message = __('messages.store_success', ['class' => __('category')]);
        $code = 201;
        return ['category' => $category, 'message' => $message, 'code' => $code];
    }

    public function show(Category $category): array
    {
        $message = __('messages.show_success', ['class' => __('category')]);
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

        $message = __('messages.update_success', ['class' => __('category')]);
        $code = 200;
        return ['category' => $category, 'message' => $message, 'code' => $code];
    }

    public function destroy(Category $category): array
    {
        //
    }
}
