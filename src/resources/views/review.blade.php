@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('content')
<main>
    <div class="container">
    <h1>Review</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('review.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="reservation_id">Date</label>
            <select id="reservation_id" name="reservation_id" class="form-control" required>
                <option value=""></option>
                @foreach($reservations as $reservation)
                    <option value="{{ $reservation->id }}">
                        {{ $reservation->reservation_date }} - {{ $reservation->restaurant->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="rating">評価</label>
            <input type="number" id="rating" name="rating" class="form-control" min="1" max="5" required>
        </div>

        <div class="form-group">
            <label for="comment">コメント</label>
            <textarea id="comment" name="comment" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">投稿する</button>
    </form>
</div>
</main>
@endsection