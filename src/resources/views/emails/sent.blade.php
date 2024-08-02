@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/sent.css') }}">
@endsection

@section('content')
<main>
    <div class="container">
        <h1>送信済みメール</h1>

        <div class="btn-container">
            <a href="{{ route('store.dashboard') }}" class="btn-back">戻る</a>
        </div>

        @if($mails->isEmpty())
            <p>送信済みのメールはありません。</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>宛先</th>
                        <th>件名</th>
                        <th>メッセージ</th>
                        <th>送信日時</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mails as $mail)
                        <tr>
                            <td>{{ $mail->to }}</td>
                            <td>{{ $mail->subject }}</td>
                            <td>{{ $mail->message }}</td>
                            <td>{{ $mail->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</main>
@endsection