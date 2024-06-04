<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StuffController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BasketController;


Route::get('/api/stuff', [StuffController::class, 'indexFront']);
Route::get('/api/stuff/filter', [StuffController::class, 'filter']);
Route::get('/api/stuff/basket', [BasketController::class, 'index'])->middleware('auth:sanctum');

Route::post('/api/login', [AuthController::class, 'login']);
Route::post('/api/register', [AuthController::class, 'register']);
Route::post('/api/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/api/add-to-busket', [BasketController::class, 'addToBusket'])->middleware('auth:sanctum');

Route::delete('/api/remove-from-basket/{id}', [BasketController::class, 'deleteToBusket']);