<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatusController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/statuses/create', [StatusController::class, 'create'])->name('statuses.create');
Route::get('/statuses', [StatusController::class, 'index'])->name('statuses.index');
Route::post('/statuses', [StatusController::class, 'store'])->name('statuses.store')->middleware('auth');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/login', function () {
    return view('auth.login'); // Después de loguear, vuelve a Home
})->name('login');

require __DIR__.'/auth.php';
