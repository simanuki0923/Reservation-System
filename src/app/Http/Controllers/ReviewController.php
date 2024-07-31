<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Restaurant;
use App\Models\Reservation;

class ReviewController extends Controller
{
    public function create()
    {
        $restaurants = Restaurant::all();
        $reservations = Reservation::where('user_id', auth()->id())->get();
        return view('review', compact('restaurants', 'reservations'));
    }

    public function store(Request $request)
{
    $request->validate([
        'restaurant_id' => 'required|exists:restaurants,id',
        'reservation_id' => 'required|exists:reservations,id',
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string|max:255',
    ]);

    Review::create([
        'user_id' => auth()->id(),
        'restaurant_id' => $request->restaurant_id,
        'reservation_id' => $request->reservation_id,
        'rating' => $request->rating,
        'comment' => $request->comment,
    ]);

    return redirect()->route('review.create')->with('success', 'レビューが投稿されました。');
}
}