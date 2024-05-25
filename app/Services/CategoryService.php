<?php

namespace App\Services;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\SubCategoryCollection;
use App\Http\Resources\SubCategoryResource;
use App\Models\Category;
use App\Models\SubCategory;

class CategoryService
{
    public function index(): array
    {
        $category = CategoryResource::collection(Category::all());
        $message = __('messages.index_success', ['class' => __('Categories')]);
        $code = 200;
        return ['category' => $category, 'message' => $message, 'code' => $code];
    }

    public function store($request): array
    {
        $category = Category::query()->create([
            'name_ar' => $request['name_ar'],
            'name_en' => $request['name_en']
        ]);

        $category = new CategoryResource($category);
        $message = __('messages.store_success', ['class' => __('category')]);
        $code = 201;
        return ['category' => $category, 'message' => $message, 'code' => $code];
    }

    public function show(Category $category): array
    {
        $category = new CategoryResource($category);
        $message = __('messages.show_success', ['class' => __('category')]);
        $code = 200;
        return ['category' => $category, 'message' => $message, 'code' => $code];
    }

    public function update($request, Category $category): array
    {
        $category->update([
            'name_ar' => $request['name_ar'] ?? $category['name_ar'],
            'name_en' => $request['name_en'] ?? $category['name_en']
        ]);
        $category = new CategoryResource($category);

        $message = __('messages.update_success', ['class' => __('category')]);
        $code = 200;
        return ['category' => $category, 'message' => $message, 'code' => $code];
    }

    public function subCategoriesList(Category $category): array
    {
        $category = SubCategory::where('category_id', $category->id)->paginate(2);
        $category = new SubCategoryCollection($category);
        $message = __('messages.index_success', ['class' => __('Categories')]);
        $code = 200;
        return ['category' => $category, 'message' => $message, 'code' => $code];
    }

    public function destroy(Category $category): array
    {
        $category->delete();

        $message = __('messages.update_success', ['class' => __('category')]);
        $code = 204;
        return ['category' => $category, 'message' => $message, 'code' => $code];
    }
}
