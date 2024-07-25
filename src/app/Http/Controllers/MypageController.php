<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        // Fetch authenticated user
        $user = Auth::user();

        // Fetch user's favorites and reservations
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
        // Fetch authenticated user
        $user = Auth::user();

        // Find and delete the reservation if it belongs to the authenticated user
        $reservation = Reservation::findOrFail($id);
        if ($reservation->user_id == $user->id) {
            $reservation->delete();
            return redirect()->route('mypage')->with('success', '予約が削除されました。');
        } else {
            return redirect()->route('mypage')->with('error', '予約を削除できません。');
        }
    }
    
    public function updateReservation(Request $request, $id)
    {
        
        

        $user = Auth::user();
        $reservation = Reservation::findOrFail($id);

        if ($reservation->user_id != $user->id) {
            return redirect()->route('mypage')->with('error', '予約を更新できません。');
        }

        // Validate the request
        $request->validate([
            'reservation_date' => 'required|date',
            'reservation_time' => 'required|date_format:H:i',
            'number_of_people' => 'required|integer|min:1',
        ]);

        $reservation->update([
            'reservation_date' => $request->input('reservation_date'),
            'reservation_time' => $request->input('reservation_time'),
            'number_of_people' => $request->input('number_of_people'),
        ]);

        return redirect()->route('mypage')->with('success', '予約が更新されました。');
    }
}