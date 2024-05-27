<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::get('logout', 'logout')->middleware('auth:sanctum');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('categories')->controller(CategoryController::class)->group(function () {
        Route::get('/', 'index')->middleware('can:category.index');
        Route::post('/', 'store')->middleware('can:category.store');
        Route::get('{category}', 'show')->middleware('can:category.show');
        Route::patch('{category}', 'update')->middleware('can:category.update');
        Route::get('{category}/subcategories', 'subCategoriesList')->middleware('can:category.show');
        Route::delete('{category}', 'destroy')->middleware('can:category.destroy');
    });

    Route::prefix('subcategories')->controller(SubCategoryController::class)->group(function () {
        Route::get('/', 'index')->middleware('can:category.index');
        Route::post('/', 'store')->middleware('can:category.store');
        Route::get('{category}', 'show')->middleware('can:category.show');
        Route::patch('{category}', 'update')->middleware('can:category.update');
        Route::delete('{category}', 'destroy')->middleware('can:category.destroy');
    });
});

Route::prefix('cities')->controller(CityController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('{city}/states', 'statesList');
});

Route::prefix('states')->controller(StateController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('{state}', 'show');
    Route::patch('{state}', 'update');
});
