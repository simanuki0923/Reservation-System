<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    @yield('css')
</head>
<body>
<main>
    <div class="container">
        <h1>管理者画面</h1>
        
        <table class="table">
            <tbody>
                <tr>
                    <td>
                        <a href="{{ route('store.create') }}" class="btn btn-primary">店舗情報の作成</a>
                    </td>
                    <td>
                        <a href="{{ route('store.reservations') }}" class="btn btn-primary">予約情報の確認</a>
                    </td>
                    <td>
                        <a href="{{ route('store.upload') }}" class="btn btn-primary">画像アップロード</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="{{ route('mail.index') }}" class="btn btn-primary">メール送信</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="{{ route('admin.logout') }}" class="btn btn-secondary"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           ログアウト
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
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
</body>
</html>