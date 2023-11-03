<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;

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
Route::get('posts', [PostController::class, 'index'])->name('post.index');
Route::get('posts/{id}', [PostController::class, 'show'])->where('id', '[0-9]+')->name('post.show');
Route::get('posts/search', [PostController::class, 'search'])->name('post.search');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('posts', [PostController::class, 'store'])->name('post.store');
    Route::put('posts/{id}', [PostController::class, 'update'])->name('post.update');
    Route::delete('posts/{id}', [PostController::class, 'destroy'])->name('post.destroy');
});