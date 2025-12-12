<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('users/list',[UserController::class,'index']);
Route::post('users/store',[UserController::class,'store']);
Route::post('users/update/{id}',[UserController::class,'update']);
Route::get('users/destroy/{id}',[UserController::class,'destroy']);
