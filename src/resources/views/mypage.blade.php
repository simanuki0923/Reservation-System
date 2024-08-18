@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
    <h1>{{ Auth::user()->name }}さん</h1>

    <div class="mypage-container">
        <div class="reservations">
            <h2>予約状況</h2>
            @if($reservations->isEmpty())
                <p>予約情報はありません。</p>
            @else
                @foreach ($reservations as $reservation)
                    <div class="reservation-card">
                        <div class="reservation-details">
                            <form action="{{ route('reservation.destroy', $reservation->id) }}" method="POST" class="reservation-delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <p>☒</p>
                                </button>
                            </form>
                            <h3>予約</h3>
                            <p>Shop <span class="reservation-value">{{ $reservation->restaurant ? $reservation->restaurant->name : 'Unknown' }}</span></p>
                            <p>Date <span class="reservation-value">{{ $reservation->reservation_date ? \Carbon\Carbon::parse($reservation->reservation_date)->format('Y-m-d') : 'N/A' }}</span></p>
                            <p>Time <span class="reservation-value">{{ $reservation->reservation_time ? \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i') : 'N/A' }}</span></p>
                            <p>Number <span class="reservation-value">{{ $reservation->number_of_people }}人</span></p>
                        </div>
                        <div class="modal fade" id="editReservationModal{{ $reservation->id }}" tabindex="-1" aria-labelledby="editReservationModalLabel{{ $reservation->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editReservationModalLabel{{ $reservation->id }}">予約変更</h5>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('reservation.update', $reservation->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group mb-3">
                                                <label for="reservation_date" class="form-label">Date</label>
                                                <input type="date" class="form-control" id="reservation_date" name="reservation_date" value="{{ $reservation->reservation_date ? \Carbon\Carbon::parse($reservation->reservation_date)->format('Y-m-d') : '' }}" required>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="reservation_time" class="form-label">Time</label>
                                                <input type="time" class="form-control" id="reservation_time" name="reservation_time" value="{{ $reservation->reservation_time ? \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i') : '' }}" required>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="number_of_people" class="form-label">Number</label>
                                                <input type="number" class="form-control" id="number_of_people" name="number_of_people" value="{{ $reservation->number_of_people }}"placeholder="Password"  required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">変更</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="favorites">
            <h2>お気に入り店舗</h2>
            @if($favorites->isEmpty())
                <p>お気に入りの店舗はありません。</p>
            @else
                <div class="favorite-cards row">
                    @foreach ($favorites as $favorite)
                        <div class="col-md-3 mb-4">
                            <div class="card">
                                <img src="{{ $favorite->restaurant->image_url }}" class="card__imgframe" alt="{{ $favorite->restaurant->name }}">
                                <div class="card__textbox">
                                    <div class="card__titletext">{{ $favorite->restaurant->name }}</div>
                                    <div class="card__overviewtext">#{{ $favorite->restaurant->area }} #{{ $favorite->restaurant->genre }}</div>
                                </div>
                                <div class="btn-group">
                                    <a href="{{ route('restaurant.show', $favorite->restaurant->id) }}" class="btn btn-primary">詳しくみる</a>
                                    <form action="{{ route('favorites.toggle', $favorite->restaurant->id) }}" method="POST" class="d-inline">
                                       @csrf
                                       <button type="submit" class="btn btn-warning favorite-button">
                                            @if(auth()->check() && auth()->user()->favorites()->where('restaurant_id', $favorite->restaurant->id)->exists())
                                                <img class="iconheart_red" src="{{ asset('img/heart_red.png') }}" alt="お気に入り削除">
                                            @else
                                                <img class="iconheart_gray" src="{{ asset('img/heart_gray.png') }}" alt="お気に入り">
                                            @endif
                                       </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection