<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        $query = Restaurant::query();

        if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('area')) {
            $query->where('area', $request->area);
        }

        if ($request->filled('genre')) {
            $query->where('genre', $request->genre);
        }


        $restaurants = $query->get();

        return view('index', compact('restaurants'));
    }

    public function detail($id)
    {
        session(['previous_url' => url()->previous()]);

        $restaurant = Restaurant::findOrFail($id);
        return view('detail', compact('restaurant'));
    }
}
