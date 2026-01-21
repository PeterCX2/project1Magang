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

Route::get('user/index', [Controllers\FilmController::class, 'userIndex'])->name('user.index')->middleware(['auth', 'user']);
Route::get('admin/index', [Controllers\FilmController::class, 'adminIndex'])->name('admin.index')->middleware(['auth', 'admin']);
Route::get('admin/category', [Controllers\CategoryController::class, 'index'])->name('admin.category')->middleware(['auth', 'admin']);
Route::get('admin/users', [Controllers\UserController::class, 'index'])->name('admin.users')->middleware(['auth', 'admin']);
Route::get('admin/create', [Controllers\FilmController::class, 'create'])->name('admin.create')->middleware(['auth', 'admin']);
Route::post('admin/store', [Controllers\FilmController::class, 'store'])->name('admin.store')->middleware(['auth', 'admin']);
Route::get('admin/edit/{id}', [Controllers\FilmController::class, 'edit'])->name('admin.edit')->middleware(['auth', 'admin']);
Route::put('admin/update/{id}', [Controllers\FilmController::class, 'update'])->name('admin.update')->middleware(['auth', 'admin']);
Route::get('admin/delete/{id}', [Controllers\FilmController::class, 'delete'])->name('admin.delete')->middleware(['auth', 'admin']);
Route::get('admin/deleteCategory/{id}', [Controllers\CategoryController::class, 'delete'])->name('admin.deleteCategory')->middleware(['auth', 'admin']);
Route::get('admin/createCategory', [Controllers\CategoryController::class, 'create'])->name('admin.createCategory')->middleware(['auth', 'admin']);
Route::post('admin/storeCategory', [Controllers\CategoryController::class, 'store'])->name('admin.storeCategory')->middleware(['auth', 'admin']);
Route::get('admin/deleteUser/{id}', [Controllers\UserController::class, 'delete'])->name('admin.deleteUser')->middleware(['auth', 'admin']);
Route::get('admin/createUser', [Controllers\UserController::class, 'create'])->name('admin.createUser')->middleware(['auth', 'admin']);
Route::post('admin/storeUser', [Controllers\UserController::class, 'store'])->name('admin.storeUser')->middleware(['auth', 'admin']);
Route::get('admin/editUser/{id}', [Controllers\UserController::class, 'edit'])->name('admin.editUser')->middleware(['auth', 'admin']);
Route::put('admin/editUser/{id}', [Controllers\UserController::class, 'update'])->name('admin.updateUser')->middleware(['auth', 'admin']);
