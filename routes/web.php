<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard.index');
});

Route::get('/', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->prefix('admin')->group(function () {

    // Users
    // Route::prefix('users')->group(function () {
    //     Route::get('/', [UserController::class, 'index'])->name('users.index');
    //     Route::get('/create', [UserController::class, 'create'])->name('users.create');
    //     Route::post('/', [UserController::class, 'store'])->name('users.store');
    //     Route::get('/{user}', [UserController::class, 'show'])->name('users.show');
    //     Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    //     Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
    //     Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    // });

    // Profiles
    // Route::prefix('profiles')->group(function () {
    //     Route::get('/', [ProfileController::class, 'index'])->name('profiles.index');
    //     Route::get('/create', [ProfileController::class, 'create'])->name('profiles.create');
    //     Route::post('/', [ProfileController::class, 'store'])->name('profiles.store');
    //     Route::get('/{profile}', [ProfileController::class, 'show'])->name('profiles.show');
    //     Route::get('/{profile}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
    //     Route::put('/{profile}', [ProfileController::class, 'update'])->name('profiles.update');
    //     Route::delete('/{profile}', [ProfileController::class, 'destroy'])->name('profiles.destroy');
    // });

    // Categories
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
        // Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
        // Route::get('/{category}', [CategoryController::class, 'show'])->name('categories.show');
        // Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        // Route::put('/{category}', [CategoryController::class, 'update'])->name('categories.update');
        // Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });

    // Brands
    // Route::prefix('brands')->group(function () {
    //     Route::get('/', [BrandController::class, 'index'])->name('brands.index');
    //     Route::get('/create', [BrandController::class, 'create'])->name('brands.create');
    //     Route::post('/', [BrandController::class, 'store'])->name('brands.store');
    //     Route::get('/{brand}', [BrandController::class, 'show'])->name('brands.show');
    //     Route::get('/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit');
    //     Route::put('/{brand}', [BrandController::class, 'update'])->name('brands.update');
    //     Route::delete('/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy');
    // });

    // Products
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products.index');
        Route::get('/create', [ProductController::class, 'create'])->name('products.create');
        // Route::post('/', [ProductController::class, 'store'])->name('products.store');
        // Route::get('/{product}', [ProductController::class, 'show'])->name('products.show');
        // Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        // Route::put('/{product}', [ProductController::class, 'update'])->name('products.update');
        // Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    });

    // Product Reviews
    // Route::prefix('products-reviews')->group(function () {
    //     Route::get('/', [ProductReviewController::class, 'index'])->name('products_reviews.index');
    //     Route::get('/create', [ProductReviewController::class, 'create'])->name('products_reviews.create');
    //     Route::post('/', [ProductReviewController::class, 'store'])->name('products_reviews.store');
    //     Route::get('/{review}', [ProductReviewController::class, 'show'])->name('products_reviews.show');
    //     Route::get('/{review}/edit', [ProductReviewController::class, 'edit'])->name('products_reviews.edit');
    //     Route::put('/{review}', [ProductReviewController::class, 'update'])->name('products_reviews.update');
    //     Route::delete('/{review}', [ProductReviewController::class, 'destroy'])->name('products_reviews.destroy');
    // });

    // Product Details
    // Route::prefix('products-details')->group(function () {
    //     Route::get('/', [ProductDetailController::class, 'index'])->name('products_details.index');
    //     Route::get('/create', [ProductDetailController::class, 'create'])->name('products_details.create');
    //     Route::post('/', [ProductDetailController::class, 'store'])->name('products_details.store');
    //     Route::get('/{detail}', [ProductDetailController::class, 'show'])->name('products_details.show');
    //     Route::get('/{detail}/edit', [ProductDetailController::class, 'edit'])->name('products_details.edit');
    //     Route::put('/{detail}', [ProductDetailController::class, 'update'])->name('products_details.update');
    //     Route::delete('/{detail}', [ProductDetailController::class, 'destroy'])->name('products_details.destroy');
    // });

    // Product Sliders
    // Route::prefix('products-sliders')->group(function () {
    //     Route::get('/', [ProductSliderController::class, 'index'])->name('products_sliders.index');
    //     Route::get('/create', [ProductSliderController::class, 'create'])->name('products_sliders.create');
    //     Route::post('/', [ProductSliderController::class, 'store'])->name('products_sliders.store');
    //     Route::get('/{slider}', [ProductSliderController::class, 'show'])->name('products_sliders.show');
    //     Route::get('/{slider}/edit', [ProductSliderController::class, 'edit'])->name('products_sliders.edit');
    //     Route::put('/{slider}', [ProductSliderController::class, 'update'])->name('products_sliders.update');
    //     Route::delete('/{slider}', [ProductSliderController::class, 'destroy'])->name('products_sliders.destroy');
    // });

    // Product Wishes
    // Route::prefix('products-wishes')->group(function () {
    //     Route::get('/', [ProductWishController::class, 'index'])->name('products_wishes.index');
    //     Route::get('/create', [ProductWishController::class, 'create'])->name('products_wishes.create');
    //     Route::post('/', [ProductWishController::class, 'store'])->name('products_wishes.store');
    //     Route::get('/{wish}', [ProductWishController::class, 'show'])->name('products_wishes.show');
    //     Route::get('/{wish}/edit', [ProductWishController::class, 'edit'])->name('products_wishes.edit');
    //     Route::put('/{wish}', [ProductWishController::class, 'update'])->name('products_wishes.update');
    //     Route::delete('/{wish}', [ProductWishController::class, 'destroy'])->name('products_wishes.destroy');
    // });

    // Product Carts
    // Route::prefix('products-carts')->group(function () {
    //     Route::get('/', [ProductCartController::class, 'index'])->name('products_carts.index');
    //     Route::get('/create', [ProductCartController::class, 'create'])->name('products_carts.create');
    //     Route::post('/', [ProductCartController::class, 'store'])->name('products_carts.store');
    //     Route::get('/{cart}', [ProductCartController::class, 'show'])->name('products_carts.show');
    //     Route::get('/{cart}/edit', [ProductCartController::class, 'edit'])->name('products_carts.edit');
    //     Route::put('/{cart}', [ProductCartController::class, 'update'])->name('products_carts.update');
    //     Route::delete('/{cart}', [ProductCartController::class, 'destroy'])->name('products_carts.destroy');
    // });

});

