<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StuffController;


Route::get('/api/stuff', [StuffController::class, 'indexFront']);