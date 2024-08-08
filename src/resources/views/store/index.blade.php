<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/index_images.css') }}">
</head>
<body>
<main>
    <div class="container">
        <form action="{{ route('store.upload') }}" method="POST" class="upload-form" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image" class="form-label">画像アップロード</label>
                <input type="file" class="form-control" name="image" id="image">
            </div>
            <div class="button-container">
                <button type="submit" class="btn btn-primary">アップロード</button>
                <a href="{{ route('store.dashboard') }}" class="btn btn-secondary">戻る</a>
            </div>
        </form>

        <!-- 画像一覧表示 -->
        @if(isset($images) && !$images->isEmpty())
            <h2 class="mt-4">アップロードされた画像</h2>
            <div class="image-gallery">
                @foreach ($images as $image)
                    <div class="image-card">
                        <img src="{{ asset('storage/images/' . $image->path) }}" alt="image">
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</main>
</body>
</html>