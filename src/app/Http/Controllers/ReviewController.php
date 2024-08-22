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

    public function store(StoreReviewRequest $request)
{
    Review::create([
        'user_id' => auth()->id(),
        'restaurant_id' => $request->restaurant_id,
        'reservation_id' => $request->reservation_id,
        'rating' => $request->rating,
        'comment' => $request->comment,
    ]);

    return redirect()->route('restaurant.show', ['id' => $request->restaurant_id])->with('success', 'レビューが投稿されました。');
}

public function show($id)
{
    $restaurant = Restaurant::findOrFail($id);
    $reviews = Review::where('restaurant_id', $id)->get();

    return view('detail', compact('restaurant', 'reviews'));
}

}