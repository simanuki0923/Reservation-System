@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('content')
    <main class="contact-form__main">
        <div class="contact-form__content">
            <div class="contact-form__heading">
                <h3>ご予約ありがとうございます</h3>
            </div>
            <form action="/" method="GET">
                <button type="submit" class="back-button">ホームに戻る</button>
            </form>
        </div>
    </main>
@endsection