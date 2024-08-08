import jsQR from "jsqr";

document.addEventListener("DOMContentLoaded", function () {
    const video = document.createElement("video");
    const canvasElement = document.getElementById("qr-canvas");
    const canvas = canvasElement.getContext("2d");

    function drawFrame() {
        if (video.readyState === video.HAVE_ENOUGH_DATA) {
            canvasElement.height = video.videoHeight;
            canvasElement.width = video.videoWidth;
            canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);

            const imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
            const code = jsQR(imageData.data, canvasElement.width, canvasElement.height);

            if (code) {
                // QRコードの内容を表示またはサーバーに送信
                console.log("QR Code Data:", code.data);
                alert("QR Code Data: " + code.data);
            }
        }
        requestAnimationFrame(drawFrame);
    }

    navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } })
        .then(function (stream) {
            video.srcObject = stream;
            video.setAttribute("playsinline", true);
            video.play();
            requestAnimationFrame(drawFrame);
        });
});