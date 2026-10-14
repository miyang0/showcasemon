<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::view('about', 'about')->name('about');
Route::view('register', 'register')->name('user.register');
Route::view('login', 'login')->name('user.login');
Route::view('/', 'home')->name('showcase.show');
Route::view('showcasedex', 'showcasedex')->name('showcase.index');
Route::view('showcase-create', 'showcase-create')->name('showcase.create');
Route::view('showcase-update', 'showcase-update')->name('showcase.update');
Route::view('showcase-destroy', 'showcase-destroy')->name('showcase.destroy');
Route::view('showcase-all', 'showcase-all')->name('showcase.admin.all');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
