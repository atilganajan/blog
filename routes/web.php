<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscribeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [BlogController::class, 'home'])->name("home");
Route::get('/category/{category}', [BlogController::class, 'getPostsByCategory'])->name("category.posts");

Route::get('/show/{slug}', [BlogController::class, 'show'])->name("show");

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/create', [BlogController::class, 'create'])->name("create");
    Route::post('/create', [BlogController::class, 'store'])->name("create");

    Route::middleware('postOwner')->group(function () {
        Route::get('/edit/{slug}', [BlogController::class, 'edit'])->name("edit");
        Route::put('/update', [BlogController::class, 'update'])->name("update")->middleware('throttle:20,1');
        Route::delete('/delete', [BlogController::class, 'delete'])->name('delete')->middleware('throttle:20,1');
    });
});

Route::post('/subscribe', [SubscribeController::class, 'subscribe'])->name("subscribe")->middleware('throttle:5,1');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::fallback(function () {
    return response()->view("error.404", [], 404);
});

