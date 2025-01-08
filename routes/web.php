<?php

use App\Http\Controllers\Client\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\ProductsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ProductsController::class, "index"])->middleware('auth')->name("index");
Route::get('/singleUserProduct/{id}', [ProductsController::class, "singleUserProduct"])->middleware('auth')->name("singleUserProduct");
Route::get('/productSorting/{price}', [ProductsController::class, "productSorting"])->middleware('auth')->name("productSorting");
Route::post('/userPurchasingProcess/{id}', [ProductsController::class, "userPurchasingProcess"])->middleware('auth')->name("userPurchasingProcess");

Route::get('/adminDashboard', [ProductsController::class, "adminDashboard"])->middleware('auth')->name("adminDashboard");
Route::get('/adminDashboardUser', [ProductsController::class, "adminDashboardUser"])->middleware('auth')->name("adminDashboardUser");
Route::get('/adminDashboardTransaction', [ProductsController::class, "adminDashboardTransaction"])->middleware('auth')->name("adminDashboardTransaction");

Route::get('/login', [AuthController::class, "login"])->name("login");
Route::post('/login/post', [AuthController::class, "post_login"])->name("post_login");
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, "register"])->name("register");
Route::post('/register/post', [AuthController::class, "post_register"])->name("post_register");

Route::get('/product/post/ui', [ProductsController::class, "post_ui"])->middleware('auth')->name("post_ui");
Route::post('/product/post', [ProductsController::class, "post_product"])->middleware('auth')->name("post_product");
Route::get('/product/put/ui/{id}', [ProductsController::class, "put_ui"])->middleware('auth')->name("put_ui");
Route::post('/product/put/{id}', [ProductsController::class, "put_product"])->middleware('auth')->name("put_product");
Route::post('/product/delete/{id}', [ProductsController::class, "delete_product"])->middleware('auth')->name("delete_product");

