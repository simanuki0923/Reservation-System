<?php

namespace App\Http\Controllers;

use App\Jobs\SendReservationDetails;
use App\Http\Requests\ReservationRequest;
use App\Models\Restaurant;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

    $reservation = Reservation::create([
        'user_id' => Auth::id(),
        'restaurant_id' => $request->input('restaurant_id'),
        'reservation_date' => $request->input('date'),
        'reservation_time' => $request->input('time'),
        'number_of_people' => $request->input('number_of_people'),
    ]);

    $url = route('reservation.check', ['reservation_id' => $reservation->id]);

    $qrCode = QrCode::size(200)->generate($url);

    $reservation->update(['qr_code' => $qrCode]);

    dispatch(new SendReservationDetails($reservation))
        ->delay(Carbon::parse($reservation->reservation_date)->setTime(9, 0));

    return response()->json([
        'success' => true,
        'reservation_id' => $reservation->id,
        'redirect_url' => route('payment.create', ['reservation_id' => $reservation->id]),
    ]);
}

public function check($reservation_id)
{
    $reservation = Reservation::find($reservation_id);

    if (!$reservation) {
        return redirect()->route('store.reservations')->withErrors('予約が見つかりませんでした。');
    }

    return view('reservation-detail', compact('reservation'));
}

}