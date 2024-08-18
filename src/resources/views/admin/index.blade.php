<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/index.css') }}">
</head>
<body>
<main>
    <div class="container">
        <h1>管理ダッシュボード</h1>
        <a href="{{ route('admin.createManager') }}" class="btn btn-primary">新規店舗代表者作成</a>
        <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-danger">ログアウト</button>
        </form>

        <h2>店舗代表者一覧</h2>
        <table class="manager-table">
            <thead>
                <tr>
                    <th>名前</th>
                    <th>メールアドレス</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($managers as $manager)
                <tr>
                    <td>{{ $manager->name }}</td>
                    <td>{{ $manager->email }}</td>
                    <td>
                        <a href="{{ route('admin.editManager', $manager->id) }}" class="btn btn-sm btn-secondary">編集</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>
</body>
</html>