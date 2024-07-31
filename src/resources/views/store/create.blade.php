@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/create.css') }}">
@endsection

@section('content')
<main>
    <div class="container">
        <h1>店舗情報の作成</h1>
        <form action="{{ route('store.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">店舗名</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="address">住所</label>
                <input type="text" name="address" id="address" class="form-control" required>
            </div>
            <div class="form-submit">
                <button type="submit" class="btn btn-primary">作成</button>
                <a href="{{ route('store.dashboard') }}" class="btn btn-secondary">戻る</a>
            </div>
        </form>
    </div>
</main>
@endsection