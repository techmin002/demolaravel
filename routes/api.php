<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('users/list',[UserController::class,'index'])->middleware('auth:sanctum');
Route::post('users/store',[UserController::class,'store']);
Route::post('users/update/{id}',[UserController::class,'update']);
Route::get('users/destroy/{id}',[UserController::class,'destroy']);
Route::post('user/register',[AuthController::class,'register']);
Route::post('user/login',[AuthController::class,'login']);
Route::get('user/logout',[AuthController::class,'logout']);
