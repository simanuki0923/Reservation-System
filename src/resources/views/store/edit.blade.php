@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/edit.css') }}">
@endsection

@section('content')
<main>
    <div class="container">
        <h1>店舗情報の編集</h1>
        <form action="{{ route('store.update', $store->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">店舗名</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $store->name }}" required>
            </div>
            <div class="form-group">
                <label for="address">住所</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ $store->address }}" required>
            </div>
            <div class="form-group-submit">
                <button type="submit" class="btn btn-primary">更新</button>
                <a href="{{ route('store.dashboard') }}" class="btn btn-secondary">戻る</a>
            </div>
        </form>
    </div>
</main>
@endsection