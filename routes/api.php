<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [Api\V1\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [Api\V1\AuthController::class, 'logout']);
    Route::get('/films', [Api\V1\FilmController::class, 'index']);
    Route::post('/films/store', [Api\V1\FilmController::class, 'store']);
    Route::post('/films/delete/{id}', [Api\V1\FilmController::class, 'delete']);
});