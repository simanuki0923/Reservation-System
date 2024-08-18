<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateReservationRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;
use App\Models\Reservation;

class MypageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    /**
     * Display the user's favorites and reservations.
     *
     * @return \Illuminate\View\View
     */
    public function mypage()
    {
        $user = Auth::user();

        $favorites = Favorite::where('user_id', $user->id)->with('restaurant')->get();
        $reservations = Reservation::where('user_id', $user->id)
                                   ->with('restaurant')
                                   ->orderBy('reservation_date', 'asc')
                                   ->orderBy('reservation_time', 'asc')
                                   ->get();
        $reservations = $reservations->map(function ($reservation) {
        $reservation->reservation_date = \Carbon\Carbon::parse($reservation->reservation_date);
        $reservation->reservation_time = \Carbon\Carbon::parse($reservation->reservation_time);
        return $reservation;
    });

        return view('mypage', [
            'favorites' => $favorites,
            'reservations' => $reservations
        ]);
    }

    /**
     * Delete a reservation.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyReservation($id)
    {
        $user = Auth::user();

        $reservation = Reservation::findOrFail($id);
        if ($reservation->user_id == $user->id) {
            $reservation->delete();
            return redirect()->route('mypage')->with('success', '予約が削除されました。');
        } else {
            return redirect()->route('mypage')->with('error', '予約を削除できません。');
        }
    }
    
    public function updateReservation(UpdateReservationRequest $request, $id)
    {
        
        $user = Auth::user();
        $reservation = Reservation::findOrFail($id);

        if ($reservation->user_id != $user->id) {
            return redirect()->route('mypage')->with('error', '予約を更新できません。');
        }

        $reservation->update([
            'reservation_date' => $request->input('reservation_date'),
            'reservation_time' => $request->input('reservation_time'),
            'number_of_people' => $request->input('number_of_people'),
        ]);

        return redirect()->route('mypage')->with('success', '予約が更新されました。');
    }
}