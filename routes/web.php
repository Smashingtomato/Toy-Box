<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/blogs', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blogs/create', [BlogController::class, 'create'])->name('blog.create')->middleware('auth');
Route::post('/blogs/store', [BlogController::class, 'store'])->name('blog.store')->middleware('auth');
Route::get('/blogs/edit/{blog}', [BlogController::class, 'edit'])->name('blog.edit')->middleware('auth');
Route::put('/blogs/edit/{blog}', [BlogController::class, 'update'])->name('blog.update')->middleware('auth');
Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blog.destroy')->middleware('auth');