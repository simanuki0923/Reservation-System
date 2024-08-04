<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Restaurant;
use App\Models\Reservation;
use App\Jobs\SendReservationDetails;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


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

    // 予約を作成し、そのインスタンスを取得
    $reservation = Reservation::create([
        'user_id' => Auth::id(),
        'restaurant_id' => $request->input('restaurant_id'),
        'reservation_date' => $request->input('date'),
        'reservation_time' => $request->input('time'),
        'number_of_people' => $request->input('number_of_people'),
        'status' => 'pending'
    ]);

    // ジョブをディスパッチし、予約のインスタンスを渡す
    SendReservationDetails::dispatch($reservation)
        ->delay(Carbon::parse($reservation->reservation_date)->setTime(9, 0));

    return redirect()->route('done')->with('success', '予約が完了しました');
}

    public function done()
    {
        return view('done');
    }
}