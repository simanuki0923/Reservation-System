<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Restaurant;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function show($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return view('detail', compact('restaurant'));
    }

    public function store(ReservationRequest $request)
    {
        $validated = $request->validated();

        Reservation::create([
            'user_id' => Auth::id(),
            'restaurant_id' => $request->input('restaurant_id'),
            'reservation_date' => $request->input('date'),
            'reservation_time' => $request->input('time'),
            'number_of_people' => $request->input('number_of_people'),
            'status' => 'pending'
        ]);

        return redirect()->route('done')->with('success', '予約が完了しました');
    }

    public function done()
    {
        return view('done');
    }
}