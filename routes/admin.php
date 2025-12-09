<?php


use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SliderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Models\Backend\AdminReviewController;

Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'uz', 'ru'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');


///////////////////////////////////////////
////    Slider Controller Route Starts Here
///////////////////////////////////////////

Route::resource('slider', SliderController::class);


///////////////////////////////////////////
////    Category Controller Route Starts Here
///////////////////////////////////////////

Route::put('change-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');
Route::resource('category', CategoryController::class);


////////////////////////////////////////////
////    Product Related Routes Starts Here
////////////////////////////////////////////

Route::get('categories/{parentId}/children', [ProductController::class, 'getChildren'])
    ->name('admin.categories.children');

Route::put('products/change-status', [ProductController::class, 'changeStatus'])->name('products.change-status');
Route::resource('products', ProductController::class);

///////////////////////////////////////////
////    Admin Product Image Gallery Route Starts Here
///////////////////////////////////////////

Route::resource('products-image-gallery', ProductImageGalleryController::class);

///////////////////////////////////////////
////    Admin Product Variant Route Starts Here
///////////////////////////////////////////


Route::put('products-variant/change-status', [ProductVariantController::class, 'changeStatus'])->name('products-variant.change-status');
Route::get(
    'products/{product}/variants',
    [ProductVariantController::class, 'index']
)->name('products-variant.index');

Route::get(
    'products/{product}/variants/create',
    [ProductVariantController::class, 'create']
)->name('products-variant.create');

Route::post(
    'products/{product}/variants',
    [ProductVariantController::class, 'store']
)->name('products-variant.store');

Route::get(
    'products/variants/{variant}/edit',
    [ProductVariantController::class, 'edit']
)->name('products-variant.edit');

Route::put(
    'products/variants/{variant}',
    [ProductVariantController::class, 'update']
)->name('products-variant.update');

Route::delete(
    'products/variants/{variant}',
    [ProductVariantController::class, 'destroy']
)->name('products-variant.destroy');

///////////////////////////////////////////
////    Admin Product Variant Item Route
///////////////////////////////////////////

Route::get(
    'products/{product}/variants/{variant}/items',
    [ProductVariantItemController::class, 'index']
)->name('products-variant-item.index');

Route::get(
    'products/{product}/variants/{variant}/items/create',
    [ProductVariantItemController::class, 'create']
)->name('products-variant-item.create');

Route::post(
    'products/{product}/variants/{variant}/items',
    [ProductVariantItemController::class, 'store']
)->name('products-variant-item.store');

Route::get(
    'products/{product}/variants/{variant}/items/{item}/edit',
    [ProductVariantItemController::class, 'edit']
)->name('products-variant-item.edit');

Route::put(
    'products/{product}/variants/{variant}/items/{item}',
    [ProductVariantItemController::class, 'update']
)->name('products-variant-item.update');

Route::delete(
    'products/{product}/variants/{variant}/items/{item}',
    [ProductVariantItemController::class, 'destroy']
)->name('products-variant-item.destroy');
Route::put('products-variant-item-status', [ProductVariantItemController::class, 'changeStatus'])->name('products-variant-item.change-status');


///////////////////////////////////////////
////    Admin Review Controller Route
///////////////////////////////////////////


Route::get('reviews', [AdminReviewController::class, 'index'])->name('reviews.index');
Route::put('reviews/change-status', [AdminReviewController::class, 'changeStatus'])->name('reviews.change-status');
