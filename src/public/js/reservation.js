function submitReservation() {
    var form = document.getElementById('reservation-form');
    var action = form.action;
    var formData = new FormData(form);

    fetch(action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); // JSONとしてレスポンスをパース
        })
        .then(data => {
            if (data.success) {
                // BladeテンプレートでURLを生成し、JavaScriptで使う
                var paymentUrl = "/payment/create?reservation_id=" + encodeURIComponent(data.reservation_id);
                window.location.href = paymentUrl;
            } else {
                alert('予約に失敗しました。');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('予約処理中にエラーが発生しました。');
        });
}

function updateReservationDetails() {
    var date = document.getElementById('date').value;
    var time = document.getElementById('time').value;
    var numberOfPeople = document.getElementById('number_of_people').value;

    if (date && time && numberOfPeople) {
        document.getElementById('reservation-date').innerText = date;
        document.getElementById('reservation-time').innerText = time;
        document.getElementById('reservation-number_of_people').innerText = numberOfPeople;

        document.getElementById('reservation-details').style.display = 'block';
    } else {
        document.getElementById('reservation-details').style.display = 'none';
    }
}