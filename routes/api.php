<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('signup', [AuthController::class, 'signup']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// ::apiResource This is a shortcut that automatically generates a full set of RESTful API routes for your PostController
// this work with automatically created set of functions in laravel controllers
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('posts', PostController::class);
});