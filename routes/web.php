<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('about-us',[FrontendController::class,'about'])->name('about');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
Route::post('/users/import', [App\Http\Controllers\UserController::class, 'import'])->name('users.import');
Route::get('/users/export', [App\Http\Controllers\UserController::class, 'export'])->name('users.export');
