<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::redirect('/', '/posts');

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::get('me', [AuthController::class, 'me']);
    });
});

Route::group(['prefix' => 'posts'], function () {
    Route::get('', [PostController::class, 'index'])->name('post.index');
    Route::get('search', [PostController::class, 'search'])->name('post.search');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('{id}', [PostController::class, 'show'])->where('id', '[0-9]+')->name('post.show');
        Route::post('', [PostController::class, 'store'])->name('post.store');
        Route::put('{id}', [PostController::class, 'update'])->name('post.update');
        Route::delete('{id}', [PostController::class, 'destroy'])->name('post.destroy');
    });
});