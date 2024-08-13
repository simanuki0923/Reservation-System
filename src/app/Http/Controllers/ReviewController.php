<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
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