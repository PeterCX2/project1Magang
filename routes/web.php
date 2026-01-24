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

Route::get('user/index',  [Controllers\FilmController::class, 'userIndex'])->name('user.index')->middleware(['auth', 'permission:view home']);
Route::get('admin/index', [Controllers\FilmController::class, 'adminIndex'])->name('admin.index')->middleware(['auth', 'permission:view film']);
Route::get('admin/category', [Controllers\CategoryController::class, 'index'])->name('admin.category')->middleware(['auth', 'permission:view category']);
Route::get('admin/users', [Controllers\UserController::class, 'index'])->name('admin.users')->middleware(['auth', 'permission:view user']);
Route::get('admin/create', [Controllers\FilmController::class, 'create'])->name('admin.create')->middleware(['auth', 'permission:create film']);
Route::post('admin/store', [Controllers\FilmController::class, 'store'])->name('admin.store')->middleware(['auth', 'permission:create film']);
Route::get('admin/edit/{id}', [Controllers\FilmController::class, 'edit'])->name('admin.edit')->middleware(['auth', 'permission:edit film']);
Route::put('admin/update/{id}', [Controllers\FilmController::class, 'update'])->name('admin.update')->middleware(['auth', 'permission:edit film']);
Route::get('admin/delete/{id}', [Controllers\FilmController::class, 'delete'])->name('admin.delete')->middleware(['auth', 'permission:delete film']);
Route::get('admin/deleteCategory/{id}', [Controllers\CategoryController::class, 'delete'])->name('admin.deleteCategory')->middleware(['auth', 'permission:delete category']);
Route::get('admin/createCategory', [Controllers\CategoryController::class, 'create'])->name('admin.createCategory')->middleware(['auth', 'permission:create category']);
Route::post('admin/storeCategory', [Controllers\CategoryController::class, 'store'])->name('admin.storeCategory')->middleware(['auth', 'permission:create category']);
Route::get('admin/deleteUser/{id}', [Controllers\UserController::class, 'delete'])->name('admin.deleteUser')->middleware(['auth', 'permission:view user']);
Route::get('admin/createUser', [Controllers\UserController::class, 'create'])->name('admin.createUser')->middleware(['auth', 'permission:view user']);
Route::post('admin/storeUser', [Controllers\UserController::class, 'store'])->name('admin.storeUser')->middleware(['auth', 'permission:view user']);
Route::get('admin/editUser/{id}', [Controllers\UserController::class, 'edit'])->name('admin.editUser')->middleware(['auth', 'permission:view user']);
Route::put('admin/editUser/{id}', [Controllers\UserController::class, 'update'])->name('admin.updateUser')->middleware(['auth', 'permission:view role']);
Route::get('admin/roles', [Controllers\RoleController::class, 'index'])->name('admin.roles')->middleware(['auth', 'permission:view role']);
Route::get('admin/createRole', [Controllers\RoleController::class, 'create'])->name('admin.createRole')->middleware(['auth', 'permission:view role']);
Route::post('admin/storeRole', [Controllers\RoleController::class, 'store'])->name('admin.storeRole')->middleware(['auth', 'permission:view role']);
Route::get('admin/editRole/{id}', [Controllers\RoleController::class, 'edit'])->name('admin.editRole')->middleware(['auth', 'permission:view role']);
Route::put('admin/updateRole/{id}', [Controllers\RoleController::class, 'update'])->name('admin.updateRole')->middleware(['auth', 'permission:view role']);
Route::get('admin/deleteRole/{id}', [Controllers\RoleController::class, 'delete'])->name('admin.deleteRole')->middleware(['auth', 'permission:view role']);
Route::get('admin/audits', [Controllers\AuditController::class, 'index'])->name('admin.audits')->middleware(['auth', 'role:super-admin|permission:view audit']);
Route::get('admin/deleteAudit/{id}', [Controllers\AuditController::class, 'delete'])->name('admin.deleteAudit')->middleware(['auth', 'role:super-admin|permission:delete audit']);
Route::get('admin/showAudit/{id}', [Controllers\AuditController::class, 'show'])->name('admin.showAudit')->middleware(['auth', 'role:super-admin|permission:view audit']);

Route::get('/no-access', function () {
    return view('errors.noAccess');
})->name('noAccess');
