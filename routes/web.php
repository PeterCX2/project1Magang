<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/login', [Controllers\AuthController::class, 'showLoginForm'])->name('login')->middleware(['guest']);
Route::post('/login', [Controllers\AuthController::class, 'login'])->name('login')->middleware(['guest']);
Route::get('/register', [Controllers\AuthController::class, 'showRegisterForm'])->name('register')->middleware(middleware: ['guest']);
Route::post('/register', [Controllers\AuthController::class, 'register'])->name('register')->middleware(['guest']);
Route::post('/logout', [Controllers\AuthController::class, 'logout'])->name('logout')->middleware(['auth']);
Route::get('/dashboard', [Controllers\RedirectController::class, 'index'])->name('dashboard')->middleware(['auth']);

Route::get('user/index', [Controllers\FilmController::class, 'userIndex'])->name('user.index')->middleware(['auth']);
Route::get('admin/index', [Controllers\FilmController::class, 'adminIndex'])->name('admin.index')->middleware(['auth']);
Route::get('admin/create', [Controllers\FilmController::class, 'create'])->name('admin.create')->middleware(['auth']);
Route::post('admin/store', [Controllers\FilmController::class, 'store'])->name('admin.store')->middleware(['auth']);
Route::get('admin/edit/{id}', [Controllers\FilmController::class, 'edit'])->name('admin.edit')->middleware(['auth']);
Route::post('admin/update/{id}', [Controllers\FilmController::class, 'update'])->name('admin.update')->middleware(['auth']);
Route::get('admin/delete/{id}', [Controllers\FilmController::class, 'delete'])->name('admin.delete')->middleware(['auth']);