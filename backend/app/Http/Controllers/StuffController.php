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
        return view('stuffs.index', ['stuffs' => $stuffs]);
    }
    public function create()
    {
        return view('stuffs.create');
    }
    public function store(Request $request)
    {
        // Валидация данных формы
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'img' => 'required|string',
            'type' => 'required|string',
            'rating' => 'required|numeric',
        ]);

        // Создание нового товара в базе данных
        Stuff::create([
            'name' => $request->name,
            'price' => $request->price,
            'img' => $request->img,
            'type' => $request->type,
            'rating' => $request->rating,
        ]);

        // Перенаправление пользователя после успешного создания товара
        return redirect()->route('stuffs.create')->with('success', 'Stuff created successfully!');
    }
}
