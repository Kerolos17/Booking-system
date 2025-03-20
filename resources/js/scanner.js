document.addEventListener("DOMContentLoaded", function () {
    let scanner;
    
    document.getElementById("startScanner").addEventListener("click", function() {
        scanner = new Html5QrcodeScanner("reader", {
            fps: 10,
            qrbox: { width: 250, height: 250 }
        });
        scanner.render(onScanSuccess, onScanError);
        document.getElementById("startScanner").classList.add("hidden");
        document.getElementById("stopScanner").classList.remove("hidden");
    });

    document.getElementById("stopScanner").addEventListener("click", function() {
        if (scanner) {
            scanner.clear();
        }
        document.getElementById("startScanner").classList.remove("hidden");
        document.getElementById("stopScanner").classList.add("hidden");
    });

    function onScanSuccess(decodedText, decodedResult) {
        fetch("/validate-qr", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ booking_id: decodedText })
        })
        .then(response => response.json())
        .then(data => {
            let statusElement = document.getElementById('status');
            if (data.status === "success") {
                statusElement.innerHTML = `
                    <p class="text-green-500">${data.message}</p>
                    <p><strong>Customer:</strong> ${data.customer_name}</p>
                    <p><strong>Phone:</strong> ${data.customer_phone}</p>
                    <p><strong>Event:</strong> ${data.event_name}</p>
                    <p><strong>Seats:</strong> ${data.seats}</p>`;
            } else {
                statusElement.innerHTML = `<p class="text-red-500">${data.message}</p>`;
            }
        })
        .catch(error => console.error("Error:", error));
    }

    function onScanError(errorMessage) {
        console.log("Scan error: ", errorMessage);
    }
});
