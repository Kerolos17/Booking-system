<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Scanner</title>
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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

        <div id="bookingDetails" class="hidden mt-6 p-4 bg-gray-900 rounded-lg shadow-md text-left">
            <h3 class="text-xl font-bold text-cyan-400 mb-2">Booking Details</h3>
            <div class="space-y-1">
                <p><strong>Customer:</strong> <span id="customerName" class="text-gray-300"></span></p>
                <p><strong>Phone:</strong> <span id="customerPhone" class="text-gray-300"></span></p>
                <p><strong>Event:</strong> <span id="eventName" class="text-gray-300"></span></p>
                <p><strong>Seats:</strong> <span id="seats" class="text-gray-300"></span></p>
            </div>
        </div>
    </div>

    <script>
        let scanner;
        document.getElementById("startScanner").addEventListener("click", function() {
            scanner = new Html5Qrcode("reader");
            scanner.start(
                { facingMode: "environment" },
                { fps: 10, qrbox: { width: 250, height: 250 } },
                onScanSuccess,
                onScanError
            ).catch(err => console.error("Camera Error: ", err));

            document.getElementById("startScanner").classList.add("hidden");
            document.getElementById("stopScanner").classList.remove("hidden");
        });

        document.getElementById("stopScanner").addEventListener("click", function() {
            if (scanner) {
                scanner.stop().then(() => {
                    document.getElementById("startScanner").classList.remove("hidden");
                    document.getElementById("stopScanner").classList.add("hidden");
                }).catch(err => console.error("Stop Error: ", err));
            }
        });

        function onScanSuccess(decodedText, decodedResult) {
            fetch("{{ route('validate.qr') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ booking_id: decodedText })
            })
            .then(response => response.json())
            .then(data => {
                let statusElement = document.getElementById('status');
                let bookingDetails = document.getElementById('bookingDetails');

                if (data.status === "success") {
                    statusElement.innerHTML = `<p class="text-green-500 font-semibold">${data.message}</p>`;

                    document.getElementById('customerName').innerText = data.customer_name;
                    document.getElementById('customerPhone').innerText = data.customer_phone;
                    document.getElementById('eventName').innerText = data.event_name;
                    document.getElementById('seats').innerText = data.seats;

                    bookingDetails.classList.remove('hidden');
                } else {
                    statusElement.innerHTML = `<p class="text-red-500 font-semibold">${data.message}</p>`;
                    bookingDetails.classList.add('hidden');
                }
            })
            .catch(error => console.error("Error:", error));
        }

        function onScanError(errorMessage) {
            console.log("Scan error: ", errorMessage);
        }
    </script>
</body>
</html>
