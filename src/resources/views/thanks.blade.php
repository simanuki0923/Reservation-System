@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
    <main class="contact-form__main">
        <div class="contact-form__content">
            <div class="contact-form__heading">
                <h3>会員登録ありがとうございます</h3>
            </div>
            @csrf
            <a href="{{ route('login') }}" class="back-button">ログインする</a>
        </div>
    </main>
@endsection