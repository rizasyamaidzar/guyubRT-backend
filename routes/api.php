<?php

use App\Http\Controllers\Api\CashController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\IncomeController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/users', UserController::class);
Route::apiResource('/homes', HomeController::class);
Route::apiResource('/categories', CategoryController::class);
Route::apiResource('/incomes', IncomeController::class);
Route::apiResource('/expenses', ExpenseController::class);
Route::apiResource('/cash', CashController::class);
Route::get('/charts', [CashController::class, 'chart']);
