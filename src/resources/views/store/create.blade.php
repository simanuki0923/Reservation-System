<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/create.css') }}">
</head>
<body>
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
                <label for="area">エリア</label>
                <input type="text" name="area" id="area" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="genre">ジャンル</label>
                <input type="text" name="genre" id="genre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">詳細</label>
                <textarea name="description" id="description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="image_url">画像URL</label>
                <input type="url" name="image_url" id="image_url" class="form-control">
            </div>
            <div class="form-submit">
                <a href="{{ route('store.dashboard') }}" class="btn btn-secondary center-text">戻る</a>
                <button type="submit" class="btn btn-primary">作成</button>
            </div>
        </form>
    </div>
</main>
</body>
</html>