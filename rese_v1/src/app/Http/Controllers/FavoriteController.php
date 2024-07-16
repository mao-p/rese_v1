<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle($restaurantId)
    {
        $user = Auth::user();

        if ($user->favoriteRestaurants()->where('restaurant_id', $restaurantId)->exists()) {
            // お気に入りを解除
            $user->favoriteRestaurants()->detach($restaurantId);
        } else {
            // お気に入りに追加
            $user->favoriteRestaurants()->attach($restaurantId);
        }

        return redirect()->back();
    }
}
