<?php

use App\Http\Controllers\Event\EventController;
use App\Http\Controllers\ForgotPassword\ForgotPasswordController;
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

Route::group(['prefix' => 'user'], function () {
    Route::get('/list', [UserController::class, 'getAllUserList']);
    // Route::post('/create', [ProductController::class, 'create']);
    // Route::get('/update/{id}', [ProductController::class, 'getProductById']);
    // Route::post('/updated', [ProductController::class, 'updateProduct']);

    Route::post('/create', [UserController::class, 'createUser']);
    Route::get('/detail/{id}', [UserController::class, 'getUserById']);
    // Route::get('/update/{id}', 'Admin\CategoryController@getCategoryById');
    Route::put('/update/{id}', [UserController::class, 'updateUser']);
    Route::delete('/delete/{id}', [UserController::class, 'deleteUser']);
});

Route::group(['prefix' => 'event'], function () {
    Route::get('/list', [EventController::class, 'getAllEventList']);
    Route::get('/top/list', [EventController::class, 'getTopEvent']);
    Route::get('/previous/list', [EventController::class, 'getPreviousEvent']);
    Route::get('/detail/{id}', [EventController::class, 'getEventById']);
    Route::delete('/delete/{id}', [EventController::class, 'deleteEventById']);
    Route::post('/create', [EventController::class, 'createEvent']);
    Route::post('/update/{id}', [EventController::class, 'updateEvent']);
});

Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password/{token}', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
