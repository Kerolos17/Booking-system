@extends('layout')

@section('title', 'Booking Confirmation')

@section('content')
<div class="bg-white text-black p-10">
    <h2 class="text-3xl mb-4">Dear {{ $booking->customer_name }},</h2>

    <p class="mb-4">Thank you for choosing Zone Hookah Lounge! We're thrilled to host you for an authentic hookah experience in a cozy, stylish atmosphere.</p>

    <div class="mb-6">
        <h3 class="text-xl font-semibold mb-2">Reservation Details:</h3>
        <ul class="list-disc pl-6">
            <li>Date: {{ $booking->booking_time->format('d M Y ') }}</li>
            <li>Time: {{ $booking->booking_time->format('H:i') }}</li>
            <li>Guests: {{ $booking->number_of_seats }}</li>
        </ul>
    </div>

    <p class="mb-4">📍 Location: <a href="https://goo.gl/maps/1234567890" class="text-blue-500 hover:text-blue-700">3322 McHenry Ave, Modesto, CA 95350</a></p>

    <p class="mb-4">If you have any questions, feel free to contact us at <a href="tel:209-408-0512">209-408-0512</a>.</p>


    <p class="mb-4">We can't wait to welcome you!</p>

    <div class="mt-6">
        <p class="font-semibold mb-2">Stay Connected:</p>
        <a href="https://www.instagram.com/zonehookahlounge/" class="text-blue-500 hover:text-blue-700">📸 Follow us on Instagram</a>
    </div>

    <div class="mt-6">
        <p>The Zone Hookah Lounge Team</p>
        <a href="https://zonehookahlounge.com/" class="text-blue-500 hover:text-blue-700">www.zonehookahlounge.com</a>
    </div>
</div>
@endsection
