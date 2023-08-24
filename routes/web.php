<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ServicePackageController;

use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use App\Http\Controllers\Client\ServiceController as ClientServiceController;
use App\Http\Controllers\Client\CartController as ClientCartController;
use App\Http\Controllers\Client\OrderController as  ClientOrderController;
use App\Http\Controllers\Client\ProfileController as  ClientProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//Client
Route::get('/', [ClientController::class,'index'])->name('client');
Route::get('/category', [ClientController::class,'showcategory']);
Route::get('/shop', [ClientProductController::class,'index'])->name('shop');
Route::get('/product/{id}', [ClientProductController::class,'showDetail'])->name('product-detail');
Route::get('/client-service', [ClientServiceController::class,'index'])->name('client-service');
Route::get('/service/{id}', [ClientServiceController::class,'showDetail'])->name('service-detail');

Route::get('/cart', [ClientCartController::class,'index'])->name('cart-product');
Route::post('/cart/{id}', [ClientProductController::class,'addToCart'])->name('cart.addToCart');
Route::put('/cart-update', [ClientCartController::class,'update'])->name('cart.update');
Route::get('/cart-delete/{id}', [ClientCartController::class,'destroy'])->name('cart.delete');

Route::get('/order', [ClientOrderController::class,'index'])->name('order-product');

Route::get('/profile', [ClientProfileController::class,'index'])->name('order-product');
//end Client

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth', 'verified']);

Route::middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('/dashboard', [HomeController::class,'index'])->name('dashboard');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/create-categories', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/store-categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/edit-categories/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/update-categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('/delete-categories/{id}', [CategoryController::class, 'destroy'])->name('categories.delete');

    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('/create-products', [ProductController::class, 'create'])->name('products.create');
    Route::post('/store-products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/edit-products/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/update-products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::get('/delete-products/{id}', [ProductController::class, 'destroy'])->name('products.delete');
    Route::get('delete-product-image/{id}', [ProductController::class ,'deleteProductImage'])->name('product.delete-image');

    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/create-users', [UserController::class, 'create'])->name('users.create');
    Route::post('/store-users', [UserController::class, 'store'])->name('users.store');
    Route::get('/edit-users/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/update-users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::put('/update-users-password/{id}', [UserController::class, 'updatePassword'])->name('users.update-password');
    Route::get('/delete-users/{id}', [UserController::class, 'destroy'])->name('users.delete');

    Route::get('/banners', [BannerController::class, 'index'])->name('banners');
    Route::get('/create-banners', [BannerController::class, 'create'])->name('banners.create');
    Route::post('/store-banners', [BannerController::class, 'store'])->name('banners.store');
    Route::get('/edit-banners/{id}', [BannerController::class, 'edit'])->name('banners.edit');
    Route::put('/update-banners/{id}', [BannerController::class, 'update'])->name('banners.update');
    Route::get('/delete-banners/{id}', [BannerController::class, 'destroy'])->name('banners.delete');

    Route::get('/services', [ServiceController::class, 'index'])->name('services');
    Route::get('/create-services', [ServiceController::class, 'create'])->name('services.create');
    Route::post('/store-services', [ServiceController::class, 'store'])->name('services.store');
    Route::get('/edit-services/{id}', [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('/update-services/{id}', [ServiceController::class, 'update'])->name('services.update');
    Route::get('/delete-services/{id}', [ServiceController::class, 'destroy'])->name('services.delete');

    Route::get('/service-packages', [ServicePackageController::class, 'index'])->name('service-packages');
    Route::get('/create-service-packages', [ServicePackageController::class, 'create'])->name('service-packages.create');
    Route::post('/store-service-packages', [ServicePackageController::class, 'store'])->name('service-packages.store');
    Route::get('/edit-service-packages/{id}', [ServicePackageController::class, 'edit'])->name('service-packages.edit');
    Route::put('/update-service-packages/{id}', [ServicePackageController::class, 'update'])->name('service-packages.update');
    Route::get('/delete-service-packages/{id}', [ServicePackageController::class, 'destroy'])->name('service-packages.delete');
});
