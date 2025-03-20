<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Scanner</title>
    <script src="https://unpkg.com/html5-qrcode@2.0.8/minified/html5-qrcode.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex items-center justify-center bg-black min-h-screen bg-cover bg-center px-4">
    <div class="bg-black bg-opacity-90 text-white p-6 sm:p-8 rounded-lg border border-blue-600 text-center max-w-xs sm:max-w-md md:max-w-lg w-full">
        <h2 class="text-2xl font-bold text-cyan-400 mb-4">Scan QR Code</h2>

        <button id="startScanner" class="bg-cyan-400 text-white border border-blue-500 px-4 py-2 rounded-lg font-semibold hover:bg-blue-500 transition duration-300">
            Start Camera
        </button>
        <button id="stopScanner" class="hidden bg-red-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-red-700 transition duration-300">
            Stop Camera
        </button>

        <div id="reader" class="mt-4 w-full"></div>
        <p id="status" class="mt-4 text-gray-300">Waiting for scan...</p>
    </div>

    <script>
        let scanner;

        document.getElementById("startScanner").addEventListener("click", function() {
            const config = {
                fps: 10,
                qrbox: { width: 250, height: 250 },
                rememberLastUsedCamera: true,
                supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA]
            };

            Html5Qrcode.getCameras().then(devices => {
                if (devices.length > 0) {
                    let cameraId = devices[0].id; // Default to first camera

                    // Use back camera for mobile, front for desktop
                    if (navigator.userAgent.match(/Android|iPhone/i)) {
                        let backCamera = devices.find(device => device.label.toLowerCase().includes("back"));
                        if (backCamera) cameraId = backCamera.id;
                    }

                    scanner = new Html5Qrcode("reader");
                    scanner.start(cameraId, config, onScanSuccess, onScanError)
                        .then(() => {
                            document.getElementById("startScanner").classList.add("hidden");
                            document.getElementById("stopScanner").classList.remove("hidden");
                        })
                        .catch(err => {
                            console.error("Camera Error:", err);
                            alert("Camera access denied or unavailable");
                        });
                } else {
                    alert("No cameras found on this device.");
                }
            }).catch(err => console.error("Camera Detection Error:", err));
        });

        document.getElementById("stopScanner").addEventListener("click", function() {
            if (scanner) {
                scanner.stop().then(() => {
                    document.getElementById("startScanner").classList.remove("hidden");
                    document.getElementById("stopScanner").classList.add("hidden");
                }).catch(err => console.error("Stop Error:", err));
            }
        });

        function onScanSuccess(decodedText, decodedResult) {
            alert("QR Code Scanned: " + decodedText);
        }

        function onScanError(errorMessage) {
            console.log("Scan error:", errorMessage);
        }
    </script>
</body>
</html>
