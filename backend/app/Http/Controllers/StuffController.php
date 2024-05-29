<?php

namespace App\Http\Controllers;

use App\Models\Stuff;
use Illuminate\Http\Request;

class StuffController extends Controller
{

    public function index()
    {
        // Получаем все товары из базы данных
        $stuffs = Stuff::all();

        // Возвращаем вид с товарами
        return response()->json($stuffs);
    }
}
