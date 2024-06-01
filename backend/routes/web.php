<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StuffController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/stuffs/index', [StuffController::class, 'index'])->name('stuffs.index');
// Маршрут для отображения формы создания товара
Route::get('/stuffs/create', [StuffController::class, 'create'])->name('stuffs.create');

// Маршрут для изменения рейтинга товара
Route::post('/stuffs/{stuff}/rate', [StuffController::class, 'rateStuff'])->name('stuffs.rate');
// Маршрут для сохранения созданного товара
Route::post('/stuffs', [StuffController::class, 'store'])->name('stuffs.store');
// Маршрут для удаленния  товара
Route::delete('/stuffs/{id}', [StuffController::class, 'destroy'])->name('stuffs.destroy');

Route::middleware('web')->group(function () {
    require __DIR__.'/api.php';
});
