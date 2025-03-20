<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        :root {
            --primary-color: #10cdd1;
            --primary-links-hover-color: #10cdd1;
            --primary-bg-color: #1c222b;
            --header-bg-color: #000000;
            --footer-bg-color: #000000;
            --primary-dark-color: #b6bdc5;
            --title-color: #ffffff;
            --fw-title-color: #1a1a1a;
            --btn-bg-color: #10cdd1;
            --btn-hover-color: #0ea6ba;
            --txt-select-bg-color: #f3d7f463;
            --logo-height: 40px;
        }
        body {
            background-color: #000000;
            font-family: 'Arial', sans-serif;
        }
        .card {
            background: rgba(0, 0, 0, 0.8);
            color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(139, 139, 139, 0.2);
        }
        .card h2 {
            color: var(--primary-color);
        }
        .btn-primary {
            background-color: var(--btn-bg-color);
            border: none;
        }
        .btn-primary:hover {
            background-color: var(--btn-hover-color);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-white">Available Events</h1>
        @foreach ($events as $event)
            <div class="card mb-3">
                <div class="card-body">
                    <h2>{{ $event->title }}</h2>
                    <p>{{ $event->description }}</p>
                    <p><strong>Date:</strong> {{ $event->event_date }}</p>
                    <p><strong>Seats Available:</strong> {{ $event->total_seats - $event->bookings->sum('number_of_seats') }}</p>
                    <a href="{{ url('/booking/' . $event->id) }}" class="btn btn-primary">Book Now</a>
                </div>
            </div>
        @endforeach
    </div>
</body>
</html>
