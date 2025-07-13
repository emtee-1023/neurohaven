@extends('layouts.app')

@section('title', 'Pesapal Payment')

@section('content')
    <div class="container py-5">
        <h2>Pesapal Payment</h2>
        <p>Booking for: <strong>{{ $booking->name }}</strong></p>
        <p>Session Time: <strong>{{ $booking->session_time }}</strong></p>
        <p>Amount: <strong>KES {{ number_format($booking->amount, 2) }}</strong></p>
        <div class="alert alert-info mt-3">
            <strong>Sample Only:</strong> This is a placeholder for the Pesapal payment integration.<br>
            When ready, you will be redirected to Pesapal to complete your payment.
        </div>
        <a href="#" class="btn btn-secondary disabled mt-3">Pay with Pesapal (Coming Soon)</a>
    </div>
@endsection
