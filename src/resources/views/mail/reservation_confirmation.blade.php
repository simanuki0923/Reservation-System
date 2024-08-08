<!DOCTYPE html>
<html>
<head>
    <title>ご予約完了のお知らせ</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mail.css') }}">
</head>
<body>
    <h1>ご予約確認のご案内</h1>
    <p>{{ $reservation->user->name }} 様,</p>
    <p>{{ $reservation->restaurant->name }} にご予約いただき、ありがとうございます。</p>
    <p>ご予約の詳細は以下の通りです：</p>
    <ul>
        <li>日付: {{ $reservation->reservation_date }}</li>
        <li>時間: {{ $reservation->reservation_time }}</li>
        <li>人数: {{ $reservation->number_of_people }}</li>
    </ul>
    <p>ご来店の際にはこちらのQRコードをご提示ください。</p>
    <div>
        {!! $qrCodeContent !!}
    </div>
</body>
</html>