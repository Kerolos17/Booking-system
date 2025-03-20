@extends('layout')

@section('title', 'Booking Confirmation')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-gray-100 text-black p-6 sm:p-8 border-2 border-blue-500 rounded-lg shadow-lg text-center">
    <h1 class="text-2xl sm:text-3xl font-bold text-primary mb-4">Booking Confirmed!</h1>

    <div class="text-left space-y-2 sm:space-y-3 text-sm sm:text-lg">
        <p><strong class="text-primary-dark">Name:</strong> {{ $booking->customer_name }}</p>
        <p><strong class="text-primary-dark">Email:</strong> {{ $booking->customer_email }}</p>
        <p><strong class="text-primary-dark">Phone:</strong> {{ $booking->customer_phone }}</p>
        <p><strong class="text-primary-dark">Seats Reserved:</strong> {{ $booking->number_of_seats }}</p>
    </div>

    <h3 class="text-lg sm:text-xl font-semibold text-primary mt-6">Your QR Code:</h3>
    <div class="flex justify-center mt-4">
        <img src="{{ asset('storage/' . $booking->qr_code) }}" alt="QR Code"
            class="w-24 h-24 sm:w-32 sm:h-32 md:w-40 md:h-40 lg:w-48 lg:h-48 ">
    </div>

    <a href="/" class="inline-block bg-btn-bg hover:bg-btn-hover text-white bg-black border-2 border-blue-600 hover:bg-blue-600 font-bold py-2 px-4 sm:py-3 sm:px-6 rounded-lg mt-6 transition duration-300">
        Back to Events
    </a>
</div>
@endsection
