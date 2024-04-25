<?php

use Illuminate\Support\Facades\Route;


Route::prefix('/api')->group(function () {
    Route::post('/auth/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('auth.register');
    Route::get('/countries', [\App\Http\Controllers\CountriesController::class, 'list'])->name('countries.list');
});
Route::get('{all}', function () {
    return view('welcome');
})->where('all', '.*');

