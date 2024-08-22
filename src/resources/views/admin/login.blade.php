<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
<main>
    <div class="auth__wrap">
        <div class="auth__header">
            管理ログイン
        </div>
        <form action="{{ route('admin.login.store') }}" method="post" class="form__item">
        @csrf
            <div class="iconName">
                <input type="text" class="form__input-item" name="name" placeholder="Name" value="{{ old('name') }}">
            </div>
            <div class="error__item">
                @error('name')
                    <span class="error__message">{{ $message }}</span>
                @enderror
            </div>
            <div class="iconPassword">
                <input type="password" class="form__input-item" name="password" placeholder="Password">
            </div>
            <div class="error__item">
                @error('password')
                    <span class="error__message">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="form__item-button">ログイン</button>
        </form>
    </div>
</main>
</body>
</html>