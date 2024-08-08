@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/reservation-detail.css') }}">
@endsection

@section('content')
<main>
    <div class="container">
        <h1>予約詳細</h1>
        <div class="reservation-details">
            <table class="table table-bordered">
                <tr>
                    <th>予約ID</th>
                    <td>{{ $reservation->id }}</td>
                </tr>
                <tr>
                    <th>店舗名</th>
                    <td>{{ $reservation->restaurant ? $reservation->restaurant->name : '店舗情報がありません' }}</td>
                </tr>
                <tr>
                    <th>予約日</th>
                    <td>{{ $reservation->reservation_date }}</td>
                </tr>
                <tr>
                    <th>予約時間</th>
                    <td>{{ $reservation->reservation_time }}</td>
                </tr>
                <tr>
                    <th>人数</th>
                    <td>{{ $reservation->number_of_people }}</td>
                </tr>
                <tr>
                    <th>予約者名</th>
                    <td>{{ $reservation->user ? $reservation->user->name : '予約者情報がありません' }}</td>
                </tr>
                <tr>
                    <th>予約者メール</th>
                    <td>{{ $reservation->user ? $reservation->user->email : '予約者情報がありません' }}</td>
                </tr>
                <tr>
                    <th>QRコード</th>
                    <td class="qr-code">
                        {!! QrCode::size(200)->generate(json_encode([
                            'reservation_id' => $reservation->id,
                            'restaurant_id' => $reservation->restaurant_id,
                            'date' => $reservation->reservation_date,
                            'time' => $reservation->reservation_time,
                        ])) !!}
                    </td>
                </tr>
            </table>
        </div>
        <div class="text-right">
            <a href="{{ route('store.reservations') }}" class="btn btn-secondary">戻る</a>
        </div>
    </div>
</main>
@endsection