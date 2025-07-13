@extends('layouts.app')

@section('title', 'Booking Confirmed')

@section('content')
    <div class="container py-5">
        <h2>Booking Confirmed!</h2>
        <p>Your session has been booked. Please proceed to payment to complete your reservation.</p>
        <div class="card p-3 mb-3">
            <p><strong>Name:</strong> {{ $booking->name }}</p>
            <p><strong>Email:</strong> {{ $booking->email }}</p>
            <p><strong>Session Time:</strong> {{ $booking->session_time }}</p>
            <p><strong>Amount:</strong> KES {{ number_format($booking->amount, 2) }}</p>
        </div>
        <a href="{{ route('pesapal.pay', $booking->id) }}" class="btn btn-success">Proceed to Payment</a>
    </div>
@endsection
