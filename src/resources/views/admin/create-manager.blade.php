@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/create-manager.css') }}">
@endsection

@section('content')
<main>
    <div class="container">
        <h1>店舗代表者の作成</h1>
        
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        <form action="{{ route('admin.storeManager') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">名前</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" class="form-control" id="password" name="password" required>
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="role">権限</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="store_manager" {{ old('role') == 'store_manager' ? 'selected' : '' }}>ストアマネージャー</option>
                    <option value="administrator" {{ old('role') == 'administrator' ? 'selected' : '' }}>管理者</option>
                </select>
                @error('role')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-buttons">
                <a href="{{ route('admin.index') }}" class="btn btn-secondary">戻る</a>
                <button type="submit" class="btn btn-primary">作成</button>
            </div>
        </form>
    </div>
</main>
@endsection