@extends('layout')

@section('title', 'Booking Confirmation')

@section('content')
<div class=" bg-white text-black p-10  ">
    <h2 class="text-3xl">Booking Confirmed!</h2>
    <p>Dear {{ $booking->customer_name }},</p>
    <p>Your booking is confirmed.</p>
    {{-- <p><strong>Date:</strong> {{ $booking->event->date }}</p> --}}
    <p><strong>Seats Reserved:</strong> {{ $booking->number_of_seats }}</p>
    <div class="qr-code mb-2">
        <h3>Your QR Code:</h3>
        <img class="border-2 border-white" src="{{ asset('storage/' . $booking->qr_code) }}" alt="QR Code">
    </div>
    <p>Your QR Code is attached to this email. Please show it at the entrance.</p>
    <br>
    <p>Thank you for booking with us!</p>
</div>
@endsection
