<!DOCTYPE html>
<html>
<head>
    <title>予約詳細</title>
</head>
<body>
    <h1>予約詳細</h1>

    <p>{{ $reservation->user ? $reservation->user->name : 'ゲスト' }}様、</p>

    <p>ご予約が確定いたしました。日時: {{ $reservation->reservation_date }} {{ $reservation->reservation_time }}。</p>

    <p>レストラン: {{ $reservation->restaurant ? $reservation->restaurant->name : '不明' }}</p>

    <p>人数: {{ $reservation->number_of_people }}人</p>

    <p>当レストランをお選びいただき、ありがとうございます！</p>
</body>
</html>