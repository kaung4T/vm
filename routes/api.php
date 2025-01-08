<?php

use App\Http\Controllers\Server\ApiAuthController;
use App\Http\Controllers\Server\ApiProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [ApiAuthController::class, 'login']);
    Route::post('logout', [ApiAuthController::class, 'logout']);
    Route::post('refresh', [ApiAuthController::class, 'refresh']);
    Route::post('user', [ApiAuthController::class, 'user']);

});

Route::middleware('auth:api')->get('/v1/products', [ApiProductsController::class, 'apiProductAll']);
Route::middleware('auth:api')->get('/v1/products/{id}', [ApiProductsController::class, 'apiProductSingle']);
Route::middleware('auth:api')->post('/v1/products', [ApiProductsController::class, 'apiProductStore']);
Route::middleware('auth:api')->put('/v1/products/update/{id}', [ApiProductsController::class, 'apiProductUpdate']);
Route::middleware('auth:api')->delete('/v1/products/delete/{id}', [ApiProductsController::class, 'apiProductDestroy']);