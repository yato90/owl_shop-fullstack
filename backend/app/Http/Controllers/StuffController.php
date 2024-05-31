<?php

namespace App\Http\Controllers;

use App\Models\Stuff;
use App\Models\Type;
use Illuminate\Http\Request;

class StuffController extends Controller
{
   
    public function index()
    {
        $stuffs = Stuff::all();

        // Возвращаем вид с товарами
        return view('stuffs.index', ['stuffs' => $stuffs]);
    }
    public function create()
    {
        $types = Type::all();
        return view('stuffs.create', compact('types'));
    }
    public function store(Request $request)
    {
        // Валидация данных формы
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'img' => 'required|string',
            'type_id' => 'required|exists:types,id',
            'rating' => 'required|numeric',
        ]);

        // Создание нового товара в базе данных
        Stuff::create([
            'name' => $request->name,
            'price' => $request->price,
            'img' => $request->img,
            'type_id' => $request->type_id,
            'rating' => $request->rating,
        ]);
        // Перенаправление пользователя после успешного создания товара
        return redirect()->route('stuffs.create')->with('success', 'Stuff created successfully!');
    }
    public function destroy(Request $request, $id)
    {
        // Найти товар по идентификатору
        $stuff = Stuff::findOrFail($id);

        // Удалить товар
        $stuff->delete();

        // Перенаправить на предыдущую страницу или куда-то еще
        return redirect()->back()->with('success', 'Stuff deleted successfully');
    }
    public function indexFront() 
    {
        // Получаем все товары из базы данных
        $stuffs1 = Stuff::all();
        return response()->json($stuffs1);
    }
}
