@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/shop_all.css') }}">
@endsection

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="search-bar mb-4">
        <form action="{{ route('shop_all') }}" method="GET">
            <div class="search-group">
                <select name="area" class="form-control">
                    <option value="">All area</option>
                    <option value="東京都" {{ request('area') == '東京都' ? 'selected' : '' }}>東京都</option>
                    <option value="大阪府" {{ request('area') == '大阪府' ? 'selected' : '' }}>大阪府</option>
                    <option value="福岡県" {{ request('area') == '福岡県' ? 'selected' : '' }}>福岡県</option>
                </select>
                <select name="genre" class="form-control">
                    <option value="">All genre</option>
                    <option value="寿司" {{ request('genre') == '寿司' ? 'selected' : '' }}>寿司</option>
                    <option value="焼肉" {{ request('genre') == '焼肉' ? 'selected' : '' }}>焼肉</option>
                    <option value="居酒屋" {{ request('genre') == '居酒屋' ? 'selected' : '' }}>居酒屋</option>
                    <option value="イタリアン" {{ request('genre') == 'イタリアン' ? 'selected' : '' }}>イタリアン</option>
                    <option value="ラーメン" {{ request('genre') == 'ラーメン' ? 'selected' : '' }}>ラーメン</option>
                </select>
                <button type="submit" class="btn btn-primary">🔍</button>
                <input type="text" name="search" class="form-control" placeholder="フリーワード検索" value="{{ request('search') }}">
            </div>
        </form>
    </div>

    <div class="row">
        @foreach ($restaurants as $restaurant)
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="{{ $restaurant->image_url }}" class="card__imgframe" alt="{{ $restaurant->name }}">
                    <div class="card__textbox">
                        <div class="card__titletext">{{ $restaurant->name }}</div>
                        <div class="card__overviewtext">#{{ $restaurant->area }} #{{ $restaurant->genre }}</div>
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('restaurant.show', $restaurant->id) }}" class="btn btn-primary">詳しくみる</a>
                        <form action="{{ route('favorites.toggle', ['id' => $restaurant->id]) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-warning favorite-button">
                                @if(auth()->check() && auth()->user()->favorites()->where('restaurant_id', $restaurant->id)->exists())
                                    <img class="iconheart_red" src="{{ asset('img/heart_red.png') }}">
                                @else
                                    <img class="iconheart_red" src="{{ asset('img/heart.png') }}">
                                @endif
                            </button>
                        </form>
                    </div>
                </div> 
            </div>
        @endforeach
    </div>
</div>
@endsection