@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<main>
    <div class="restaurant-details">
        <div class="card">
            <img src="{{ $restaurant->image_url }}" class="card__imgframe" alt="{{ $restaurant->name }}">
            <div class="card__textbox">
                <div class="card__titletext">{{ $restaurant->name }}</div>
                <div class="card__overviewtext">
                    <p>エリア: {{ $restaurant->area }}</p>
                    <p>ジャンル: {{ $restaurant->genre }}</p>
                    <p>詳細: {{ $restaurant->description }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="reservation-container">
        <h3>予約</h3>
        <form action="{{ route('reservation.store') }}" method="POST">
            @csrf
            <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
            <div class="form-group">
                <label for="date" class="form-label">日程</label>
                <input type="date" id="date" name="date" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}" max="2050-12-31" class="form-control" onchange="updateReservationDetails()" />
                @error('reservation_date')
                   <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="time" class="form-label">時間</label>
                <select id="time" name="time" class="form-select" onchange="updateReservationDetails()">
                    <option value="" selected>時間を選択</option>
                    <option value="17:00">17:00</option>
                    <option value="18:00">18:00</option>
                    <option value="19:00">19:00</option>
                </select>
                @error('reservation_time')
                   <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="number_of_people" class="form-label">人数</label>
                <select id="number_of_people" name="number_of_people" class="form-select" onchange="updateReservationDetails()">
                    <option value="" selected>人数を選択</option>
                    <option value="1">1人</option>
                    <option value="2">2人</option>
                    <option value="3">3人</option>
                </select>
                @error('number_of_people')
                   <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div id="reservation-details" style="display: none;">
                <p>Shop: {{ $restaurant->name }}</p>
                <p>Date: <span id="reservation-date"></span></p>
                <p>Time: <span id="reservation-time"></span></p>
                <p>Number: <span id="reservation-number_of_people"></span>人</p>
            </div>
            <div class="btn-container">
                <button class="btn" type="submit">予約</button>
            </div>
        </form>
    </div>
</main>

<script>
    function updateReservationDetails() {
        var date = document.getElementById('date').value;
        var time = document.getElementById('time').value;
        var numberOfPeople = document.getElementById('number_of_people').value;

        if (date && time && numberOfPeople) {
            document.getElementById('reservation-date').innerText = date;
            document.getElementById('reservation-time').innerText = time;
            document.getElementById('reservation-number_of_people').innerText = numberOfPeople;

            document.getElementById('reservation-details').style.display = 'block';
        } else {
            document.getElementById('reservation-details').style.display = 'none';
        }
    }
</script>
@endsection