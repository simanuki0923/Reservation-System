@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/send-email.css') }}">
@endsection

@section('content')
    <main>
        <div class="container mx-auto p-4">
            <h1 class="text-2xl font-bold mb-4">メール送信</h1>

            @if (session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif

            <form action="/emails/send-email" method="POST">
                @csrf
                <div class="form-group">
                    <label for="to" class="form-label">送信先</label>
                    <input type="email" id="to" name="to" value="{{ old('to') }}" class="form-input" required>
                    @error('to')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="subject" class="form-label">件名</label>
                    <input type="text" id="subject" name="subject" value="{{ old('subject') }}" class="form-input" required>
                    @error('subject')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="message" class="form-label">メッセージ</label>
                    <textarea id="message" name="message" rows="4" class="form-textarea" required>{{ old('message') }}</textarea>
                    @error('message')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-actions flex justify-end mt-4">
                    <button type="submit" class="submit-button">
                        送信
                    </button>
                    <a href="{{ route('store.dashboard') }}" class="back-button ml-4">
                        戻る
                    </a>
                </div>
            </form>
        </div>
    </main>
@endsection