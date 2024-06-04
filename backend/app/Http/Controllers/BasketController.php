<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Basket;
use App\Models\Basket_stuff;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function index() 
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Необходима авторизация'], 401);
        }
        $basketStuffs = Basket_stuff::where('basket_id', $user->basket->id)
        ->with('stuff')
        ->get();
        //$basketStuffs = Basket_stuff::with('stuff')->get();
        return response()->json($basketStuffs);
    }
    public function addToBusket(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Необходима авторизация'], 401);
        }
        //$user = Auth::user();
        $stuffId = $request->input('stuff_id');

        // Получаем корзину пользователя или создаем новую
        //$busket = Basket::firstOrCreate(['user_id' => $user->id]);
        // Ищем активную корзину пользователя
        $busket = Basket::where('user_id', $user->id)
        ->whereNull('deactivated_at')
        ->first();

        if (!$busket) {
            return response()->json(['message' => 'Корзина не найдена или неактивна'], 404);
        }

        // Добавляем товар в корзину
        Basket_stuff::create([
            'basket_id' => $busket->id,
            'stuff_id' => $stuffId
        ]);

        return response()->json(['message' => 'Товар добавлен в корзину'], 200);
    }
    public function deleteToBusket($id)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Необходима авторизация'], 401);
        }
        try {
            $basketStuff = Basket_stuff::where('stuff_id', $id)
            ->where('basket_id', $user->basket->id)
            ->firstOrFail();
            //$basketStuff = Basket_stuff::where('stuff_id', $id)->firstOrFail();
            
            // Удалите запись
            $basketStuff->delete();
            return response()->json(['message' => 'Товар успешно удален из корзины'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ошибка удаления товара из корзины', 'error' => $e->getMessage()], 500);
        }
    }
}
