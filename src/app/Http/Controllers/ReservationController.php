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

    // 予約を作成し、そのインスタンスを取得
    $reservation = Reservation::create([
        'user_id' => Auth::id(),
        'restaurant_id' => $request->input('restaurant_id'),
        'reservation_date' => $request->input('date'),
        'reservation_time' => $request->input('time'),
        'number_of_people' => $request->input('number_of_people'),
        // ここではQRコードの生成をまだ行わない
    ]);

    // QRコードを生成するためのデータを作成
    $data = [
        'reservation_id' => $reservation->id,
        'restaurant_id' => $request->input('restaurant_id'),
        'date' => $request->input('date'),
        'time' => $request->input('time'),
    ];
    
    // JSON形式でデータをエンコード
    $qrCodeData = json_encode($data);

    // QRコードを生成
    $qrCode = QrCode::size(200)->generate($qrCodeData);

    // QRコードを文字列として保存する
    $qrCodeString = (string) $qrCode;

    // 予約情報を更新してQRコードを保存する
    $reservation->update(['qr_code' => $qrCodeString]);

    // ジョブをディスパッチし、予約のインスタンスを渡す
    dispatch(new SendReservationDetails($reservation))
        ->delay(Carbon::parse($reservation->reservation_date)->setTime(9, 0));

    return response()->json([
            'success' => true,
            'reservation_id' => $reservation->id,
            'redirect_url' => route('payment.create', ['reservation_id' => $reservation->id]),
        ]);
  }

}