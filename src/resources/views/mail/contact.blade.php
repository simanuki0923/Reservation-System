<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メールのご案内</title>
    <link rel="stylesheet" href="{{ asset('css/email.css') }}">
</head>
<body>
    <p>{{ $data['name'] ?? '名前がありません' }}様</p>
    <p>{!! nl2br(e($data['message'] ?? 'メッセージがありません')) !!}</p>
</body>
</html>