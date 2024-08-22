@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('メールアドレスの確認') }}</div>

                    <div class="card-body">
                        @if (session('status') == 'verification-link-sent')
                            <div class="alert alert-success" role="alert">
                                {{ __('新しい確認リンクが、登録時に提供したメールアドレスに送信されました。') }}
                            </div>
                        @endif

                        <p>{{ __('続行する前に、メールで確認リンクを確認してください。') }}</p>
                        <p>{{ __('もしメールを受け取っていない場合は') }},
                            <form method="POST" action="{{ route('verification.send') }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('こちらをクリックして再送信してください') }}</button>.
                            </form>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection