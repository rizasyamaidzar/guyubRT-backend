<?php

use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/homes', HomeController::class);
Route::apiResource('/categories', CategoryController::class);
