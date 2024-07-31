@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
@endsection

@section('content')
<main>
    <div class="container">
        <h1>管理者画面</h1>
        <a href="{{ route('store.create') }}" class="btn btn-primary">店舗情報の作成</a>
        <a href="{{ route('store.reservations') }}" class="btn btn-primary">予約情報の確認</a>
        <a href="{{ route('admin.login') }}" class="btn btn-secondary">ログアウト</a>
        @if($stores->isEmpty())
            <p>店舗情報はありません。</p>
        @else
        <table class="table">
                <thead>
                    <tr>
                        <th>店舗名</th>
                        <th>住所</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stores as $store)
                        <tr>
                            <td>{{ $store->name }}</td>
                            <td>{{ $store->address }}</td>
                            <td>
                                <a href="{{ route('store.edit', $store->id) }}" class="btn btn-secondary">編集</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</main>
@endsection