<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Favorite;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    //店舗フィルタリング機能
    public function index(Request $request)
    {
        $query = Restaurant::query();
           if ($request->filled('area')) {
            $query->where('area', $request->input('area'));
        } 
    

    if ($request->filled('genre')) {  
          $query->where('genre', $request->input('genre'));
        }

    if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('search') . '%')
                  ->orWhere('description', 'like', '%' . $request->input('search') . '%')
                  ->orWhere('area', 'like', '%' . $request->input('search') . '%')
                  ->orWhere('genre', 'like', '%' . $request->input('search') . '%');
            });
        }

        $restaurants = $query->get();

        return view('shop_all', ['restaurants' => $restaurants]);
    }
}