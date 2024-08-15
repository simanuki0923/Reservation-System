<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
</head>
<body>
    <header>
        <div class="header__logo">Rese</div>
    <div class="hamburger-menu">
        <input type="checkbox" id="menu-btn-check">
        <label for="menu-btn-check" class="menu-btn"><span></span></label>
        <div class="menu-content">
            <ul>
                <li class="nav__item"><a class="nav__item-link" href="/">Home</a></li>
                @if(Auth::check())
                <li class="nav__item">
                    <li class="nav__item">
                       <form action="{{ route('logout') }}" method="POST" class="nav__item-link-form">
                           @csrf
                           <button type="submit" class="nav__item-link">Logout</button>
                        </form>
                   </li>
                    </form>
                    <li class="nav__item">
                        <a class="nav__item-link" href="{{ route('mypage') }}">Mypage</a></li> 
                @else
                    <li class="nav__item">
                        <a class="nav__item-link" href="/register">Registration</a></li>
                    <li class="nav__item"><a class="nav__item-link" href="/login">Login</a></li>
                @endif
            </ul>
        </div>
    </div>
       @yield('header')
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>