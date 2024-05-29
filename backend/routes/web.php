<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StuffController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/stuffs', [StuffController::class, 'index'])->name('stuffs.index');
