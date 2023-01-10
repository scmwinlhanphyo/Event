<?php

use App\Http\Controllers\Event\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'user'], function() {
    Route::get('/list', [UserController::class, 'getAllUserList']);
    // Route::post('/create', [ProductController::class, 'create']);
    // Route::get('/update/{id}', [ProductController::class, 'getProductById']);
    // Route::post('/updated', [ProductController::class, 'updateProduct']);

    Route::post('/create', [UserController::class, 'createUser']);
    // Route::get('/detail/{id}', 'Admin\CategoryController@getCategoryById');
    // Route::get('/update/{id}', 'Admin\CategoryController@getCategoryById');
    // Route::post('/updated', 'Admin\CategoryController@updateCategory');
    // Route::delete('/delete/{id}', 'Admin\CategoryController@deleteCategory');
});

Route::group(['prefix' => 'event'], function() {
    Route::get('/list', [EventController::class, 'getAllEventList']);
    // Route::get('/', [EventController::class, 'getAllEvent']);
    // Route::post('/create', [ProductController::class, 'create']);
    // Route::get('/update/{id}', [ProductController::class, 'getProductById']);
    // Route::post('/updated', [ProductController::class, 'updateProduct']);
});
