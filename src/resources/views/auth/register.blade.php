@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<body>
  <main>
    <div class="auth__wrap">
        <div class="auth__header">
            Registration
        </div>
        <form action="{{ route('register') }}" method="post" class="form__item">
            @csrf
            <div class="iconUser">
                <input type="text" class="form__input-item" name="name" placeholder="Username" value="{{ old('name') }}">
            </div>
            <div class="error__item">
                @error('name')
                    <span class="error__message">{{ $message }}</span>
                @enderror
            </div>
            <div class="iconEmail">
                <input type="email" class="form__input-item" name="email" placeholder="Email" value="{{ old('email') }}">
            </div>
            <div class="error__item">
                @error('email')
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
            <button type="submit" class="form__item-button">登録</button>
        </form>
    </div>
  </main>
</body>
@endsection