@extends('layout')

@section('title', 'Book Event')

@section('content')
<div class="max-w-lg mx-auto mt-10 bg-black text-white border border-blue-500 p-8 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold text-primary text-center mb-6">Book Your Event</h2>

    <form action="{{ route('booking.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-primary-dark font-semibold">Full Name</label>
            <input type="text" name="customer_name" class="w-full mt-1 p-3 border border-blue-300 rounded-lg focus:ring-primary focus:border-primary" required>
            @error('customer_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-primary-dark font-semibold">Email</label>
            <input type="email" name="customer_email" class="w-full mt-1 p-3 border border-blue-300 rounded-lg focus:ring-primary focus:border-primary" required>
            @error('customer_email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-primary-dark font-semibold">Phone Number</label>
            <input type="text" name="customer_phone" class="w-full mt-1 p-3 border border-blue-300 rounded-lg focus:ring-primary focus:border-primary" required>
            @error('customer_phone')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-primary-dark font-semibold">Number of Seats</label>
            <input type="number" name="number_of_seats" class="w-full mt-1 p-3 border border-blue-300 rounded-lg focus:ring-primary focus:border-primary" min="1" required>
            @error('number_of_seats')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full bg-btn-bg hover:bg-blue-600 text-white border border-blue-700 font-bold py-3 rounded-lg transition duration-300">
            Confirm Booking
        </button>
    </form>
</div>
@endsection
