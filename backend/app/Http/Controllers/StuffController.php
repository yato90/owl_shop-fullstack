<?php

namespace App\Http\Controllers;

use App\Models\Stuff;
use App\Models\Type;
use App\Models\RatingUser;
use App\Models\StuffInfo;
use Illuminate\Http\Request;

class StuffController extends Controller
{
    public function rateStuff(Request $request, $stuffId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $rating = new RatingUser([
            'stuff_id' => $stuffId,
            'user_id' => $request->user()->id,
            'rating' => $request->input('rating'),
        ]);

        $rating->save();

        $stuff = Stuff::findOrFail($stuffId);
        $stuff->rating = $stuff->calculateRating();
        $stuff->save();

        return response()->json(['message' => 'Rating added successfully', 'rating' => $stuff->rating]);
    }
    public function index()
    {
        $stuffs = Stuff::with('type', 'info')->get();
        foreach ($stuffs as $stuff) {
            $stuff->rating = $stuff->calculateRating();
        }

        // Возвращаем вид с товарами
        return view('stuffs.index', compact('stuffs'));
    }
    public function create()
    {
        $stuff = new Stuff();
        $types = Type::all();
        return view('stuffs.create', compact('types', 'stuff'));
    }
    public function store(Request $request)
    {
        // Валидация данных формы
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'img' => 'required|string',
            'type_id' => 'required|exists:types,id',
            'info.*.title' => 'required|string',
            'info.*.description' => 'required|string',
        ]);

        // Создание нового товара в базе данных
        $stuff = Stuff::create([
            'name' => $request->name,
            'price' => $request->price,
            'img' => $request->img,
            'type_id' => $request->type_id,
        ]);
        foreach ($request->info as $info) {
            StuffInfo::create([
                'stuff_id' => $stuff->id,
                'title' => $info['title'],
                'description' => $info['description'],
            ]);
        }
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
    public function filter(Request $request)
    {
        $query = Stuff::query();

        // Применяем фильтры к таблице stuffs
        if ($request->has('minPrice')) {
            $query->where('price', '>=', $request->input('minPrice'));
        }
        if ($request->has('maxPrice')) {
            $query->where('price', '<=', $request->input('maxPrice'));
        }
        if ($request->has('categories') && !empty($request->input('categories'))) {
            $query->whereIn('type_id', $request->categories);
        }
        if ($request->has('rating') && !empty($request->input('rating'))) {
            $query->whereIn('rating', $request->rating);
        }
        // Применяем фильтры к таблице stuffs_info
        if ($request->has('sizes')) {
            $query->whereHas('info', function($q) use ($request) {
                $q->whereIn('title', ['size'])->whereIn('description', (array) $request->input('sizes'));
            });
        }
        if ($request->has('colors')) {
            $query->whereHas('info', function($q) use ($request) {
                $q->whereIn('title', ['color'])->whereIn('description', (array) $request->input('colors'));
            });
        }

        $stuffs = $query->with('info')->get();

        return response()->json($stuffs);
    }
}
