<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Favorite;

class UserController extends Controller
{
    public function mypage()
    {
        $user = Auth::user();
        $reservations = $user ? $user->reservations : collect();
        $favorites = $user ? $user->favoriteRestaurants : collect();

        return view('mypage', compact('reservations', 'favorites'));
    }
}
