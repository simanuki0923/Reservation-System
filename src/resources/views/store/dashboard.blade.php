@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
@endsection

@section('content')
<main>
    <div class="container">
        <h1>管理者画面</h1>
        
        <!-- 店舗情報作成リンク -->
        <a href="{{ route('store.create') }}" class="btn btn-primary">店舗情報の作成</a>

        <!-- 予約情報確認リンク -->
        <a href="{{ route('store.reservations') }}" class="btn btn-primary">予約情報の確認</a>

        <!-- 画像アップロードリンク -->
        <a href="{{ route('store.upload') }}" class="btn btn-primary">画像アップロード</a>

        <!-- メール送信リンク -->
        <a href="{{ route('emails.send.email.form') }}" class="btn btn-primary">メール送信</a>

        <!-- 送信済みメールリンク -->
        <a href="{{ route('emails.sent') }}" class="btn btn-primary">送信済みメールの確認</a>

        <!-- ログアウトリンク -->
        <a href="{{ route('store.logout') }}" class="btn btn-secondary"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
           ログアウト
        </a>
        
        <!-- ログアウトフォーム -->
        <form id="logout-form" action="{{ route('store.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <!-- 店舗情報が存在するかどうかのチェック -->
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