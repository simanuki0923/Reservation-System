@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/reservations.css') }}">
@endsection

@section('content')
<main>
    <div class="container">
        <h1>予約情報の確認</h1>
        @if($reservations->isEmpty())
            <p>予約情報がありません。</p>
        @else
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>店舗名</th>
                            <th>予約日</th>
                            <th>予約時間</th>
                            <th>人数</th>
                            <th>予約者名</th>
                            <th>予約者メール</th>
                            <th>詳細</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->id }}</td>
                                <td>
                                    @if($reservation->restaurant)
                                        {{ $reservation->restaurant->name }}
                                    @else
                                        店舗情報がありません
                                    @endif
                                </td>
                                <td>{{ $reservation->reservation_date }}</td>
                                <td>{{ $reservation->reservation_time }}</td>
                                <td>{{ $reservation->number_of_people }}</td>
                                <td>
                                    @if($reservation->user)
                                        {{ $reservation->user->name }}
                                    @else
                                        予約者情報がありません
                                    @endif
                                </td>
                                <td>
                                    @if($reservation->user)
                                        {{ $reservation->user->email }}
                                    @else
                                        予約者情報がありません
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('store.reservation.detail', $reservation->id) }}" class="btn btn-info">詳細</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-right">
                <a href="{{ route('store.dashboard') }}" class="btn btn-secondary">戻る</a>
            </div>
        @endif
    </div>
</main>
@endsection