<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

Auth::routes();

Route::redirect('/', '/posts');
Route::get('posts', [PostController::class, 'index'])->name('post.index');
Route::get('posts/{id}', [PostController::class, 'show'])->where('id', '[0-9]+')->name('post.show');
Route::get('posts/search', [PostController::class, 'search'])->name('post.search');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('posts/create', [PostController::class, 'create'])->name('post.create');
    Route::post('posts', [PostController::class, 'store'])->name('post.store');
    Route::get('posts/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::put('posts/{id}', [PostController::class, 'update'])->name('post.update');
    Route::delete('posts/{id}/delete', [PostController::class, 'destroy'])->name('post.destroy');
});