@extends('layout')

@section('title', 'Booking Confirmation')

@section('content')
<div class="container">
    <h2>Booking Confirmed!</h2>
    <p>Dear {{ $booking->customer_name }},</p>
    <p>Your booking is confirmed.</p>
    {{-- <p><strong>Date:</strong> {{ $booking->event->date }}</p> --}}
    <p><strong>Seats Reserved:</strong> {{ $booking->number_of_seats }}</p>
    <div class="qr-code">
        <h3>Your QR Code:</h3>
        <img src="{{ asset('storage/' . $booking->qr_code) }}" alt="QR Code">
    </div>
    <p>Your QR Code is attached to this email. Please show it at the entrance.</p>
    <br>
    <p>Thank you for booking with us!</p>
</div>
@endsection
