<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StuffController;
use App\Http\Controllers\AuthController;


Route::get('/api/stuff', [StuffController::class, 'indexFront']);
Route::get('/api/stuff/filter', [StuffController::class, 'filter']);

Route::post('/api/login', [AuthController::class, 'login']);
Route::post('/api/register', [AuthController::class, 'register']);
Route::post('/api/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');