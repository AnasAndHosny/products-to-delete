<?php

namespace App\Services;

use App\Http\Resources\ProductCollection;
use App\Models\Product;
use App\Http\Resources\ProductResource;

class ProductService
{
    public function index(): array
    {
        $product = new ProductCollection(Product::paginate());
        $message = __('messages.index_success', ['class' => __('products')]);
        $code = 200;
        return ['product' => $product, 'message' => $message, 'code' => $code];
    }

    public function store($request): array
    {
        $image = ImageService::store($request);
        $product = Product::query()->create([
            'image' => $image,
            'name_ar' => $request['name_ar'],
            'name_en' => $request['name_en'],
            'description_ar' => $request['description_ar'],
            'description_en' => $request['description_en'],
            'manufacturer_id' => $request['manufacturer_id'],
            'price' => $request['price'],
            'subcategory_id' => $request['subcategory_id']
        ]);

        $product = new ProductResource($product);
        $message = __('messages.store_success', ['class' => __('product')]);
        $code = 201;
        return ['product' =>  $product, 'message' => $message, 'code' => $code];
    }

    public function show(Product $product): array
    {
        $product = new ProductResource($product);
        $message = __('messages.show_success', ['class' => __('product')]);
        $code = 200;
        return ['product' => $product, 'message' => $message, 'code' => $code];
    }

    public function update($request, Product $product): array
    {
        $image = ImageService::update($request, $product);
        $product->update([
            'image' => $image,
            'name_ar' => $request['name_ar'] ?? $product['name_ar'],
            'name_en' => $request['name_en'] ?? $product['name_en'],
            'description_ar' => $request['description_ar'] ?? $product['description_ar'],
            'description_en' => $request['description_en'] ?? $product['description_en'],
            'manufacturer_id' => $request['manufacturer_id'] ?? $product['manufacturer_id'],
            'price' => $request['price'] ?? $product['price'],
            'subcategory_id' => $request['subcategory_id'] ?? $product['subcategory_id'],
        ]);

        $product = new ProductResource($product);
        $message = __('messages.update_success', ['class' => __('product')]);
        $code = 200;
        return ['product' => $product, 'message' => $message, 'code' => $code];
    }

    public function destroy(Product $product): array
    {
        //
    }

}
