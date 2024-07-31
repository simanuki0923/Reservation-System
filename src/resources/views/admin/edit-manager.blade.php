@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/edit-manager.css') }}">
@endsection

@section('content')
<main>
    <div class="container">
        <h2>店舗代表者情報編集</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.updateManager', $manager->id) }}">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name">名前</label>
                <input type="text" id="name" name="name" value="{{ old('name', $manager->name) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password">パスワード（変更する場合のみ）</label>
                <input type="password" id="password" name="password" class="form-control">
            </div>

            <div class="form-group">
                <label for="role">権限</label>
                <select id="role" name="role" class="form-control" required>
                    <option value="store_manager" {{ $manager->role == 'store_manager' ? 'selected' : '' }}>ストアマネージャー</option>
                    <option value="admin" {{ $manager->role == 'admin' ? 'selected' : '' }}>管理者</option>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">更新</button>
                <form action="{{ route('admin.deleteManager', $manager->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">削除</button>
                </form>
                <a href="{{ route('admin.index') }}" class="btn btn-secondary">戻る</a>
            </div>
        </form>
    </div>
</main>
@endsection