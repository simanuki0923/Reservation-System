@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/qr-scan.css') }}">
@endsection

@section('content')
<main>
    <div class="container">
        <h1>QRコードスキャン</h1>
        
        <div class="qr-scanner">
            <video id="qr-video"></video>
            <p id="qr-result"></p>
        </div>
        
        <div id="reservation-details" style="display:none;">
            <h2>予約詳細</h2>
            <p>ID: <span id="reservation-id"></span></p>
            <p>店舗名: <span id="reservation-restaurant"></span></p>
            <p>予約日: <span id="reservation-date"></span></p>
            <p>予約時間: <span id="reservation-time"></span></p>
            <p>人数: <span id="reservation-people"></span></p>
            <p>予約者: <span id="reservation-user-name"></span></p>
            <p>予約者メール: <span id="reservation-user-email"></span></p>
        </div>

        <div class="btn-container">
            <a href="{{ route('store.dashboard') }}" class="btn btn-secondary">戻る</a>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/@zxing/library@0.18.5/umd/index.min.js"></script>
<script>
    window.addEventListener('load', function () {
        let selectedDeviceId;
        const codeReader = new ZXing.BrowserQRCodeReader()
        console.log('ZXing code reader initialized')

        codeReader.getVideoInputDevices()
            .then((videoInputDevices) => {
                videoInputDevices.forEach((element) => {
                    const sourceOption = document.createElement('option')
                    sourceOption.text = element.label
                    sourceOption.value = element.deviceId
                })

                if (videoInputDevices.length > 0) {
                    selectedDeviceId = videoInputDevices[0].deviceId
                    codeReader.decodeFromVideoDevice(selectedDeviceId, 'qr-video', (result, err) => {
                        if (result) {
                            console.log(result)
                            document.getElementById('qr-result').textContent = result.text
                            checkReservation(result.text)
                        }
                        if (err && !(err instanceof ZXing.NotFoundException)) {
                            console.error(err)
                            document.getElementById('qr-result').textContent = err
                        }
                    })
                }
            })
            .catch((err) => {
                console.error(err)
            })

        function checkReservation(qrCodeData) {
            fetch("{{ route('store.check.reservation') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ qr_code_data: qrCodeData })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    document.getElementById('reservation-id').textContent = data.reservation.id;
                    document.getElementById('reservation-restaurant').textContent = data.reservation.restaurant.name;
                    document.getElementById('reservation-date').textContent = data.reservation.reservation_date;
                    document.getElementById('reservation-time').textContent = data.reservation.reservation_time;
                    document.getElementById('reservation-people').textContent = data.reservation.number_of_people;
                    document.getElementById('reservation-user-name').textContent = data.reservation.user.name;
                    document.getElementById('reservation-user-email').textContent = data.reservation.user.email;
                    document.getElementById('reservation-details').style.display = 'block';
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        }
    });
</script>
@endsection