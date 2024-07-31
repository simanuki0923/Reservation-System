@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/edit-manager.css') }}">
@endsection

@section('content')
<main>
    <div class="container">
        <h2>ストアマネージャーを編集</h2>

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
            <div class="actions-container">
                <button type="submit" class="btn btn-primary">更新</button>
            </div>
        </form>

        <form method="POST" action="{{ route('admin.deleteManager', $manager->id) }}" style="margin-top: 20px;">
            @csrf
            @method('DELETE')
            <div class="actions-container">
                <button type="submit" class="btn btn-danger">削除</button>
            </div>
        </form>
        
        <div class="actions-container">
            <a href="{{ route('admin.index') }}" class="btn btn-secondary">戻る</a>
        </div>
    </div>
</main>
@endsection