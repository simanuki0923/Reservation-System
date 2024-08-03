<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    @yield('css')
</head>
<body>
    <header>
        <div class="header__logo">Rese</div>
    </header>
    <main>
         <form action="{{ url('mail') }}" method='POST'>
            @csrf
            <div class="form-group">
                
                <input type="text" name="name" value="{{ old('name') }}" placeholder="名前" class="form-control">
                @if ($errors->has('name'))
                <p class="bg-danger">{{ $errors->first('name') }}</p>
                @endif

                <input type="text" name="message" value="{{ old('message') }}" placeholder="メッセージ" class="form-control">
                @if ($errors->has('message'))
                <p class="bg-danger">{{ $errors->first('message') }}</p>
                @endif

                <div class="button-group">
                    <input type="submit" value="送信" class="btn">
                    <a href="{{ route('store.dashboard') }}" class="btn btn-secondary">戻る</a>
                </div>
            </div>
        </form>

        @if (Session::has('success'))
        <div>
            <p class="bg-warning text-center">{{ Session::get('success') }}</p>
        </div>
        @endif
    </main>
</body>
</html>