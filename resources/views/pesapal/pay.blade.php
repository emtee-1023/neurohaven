@extends('layouts.app')

@section('title', 'Pesapal Payment')

@section('content')
    @include('partials.nav')
    <!-- Page Title -->
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Order Summary</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('landing') }}">Home</a></li>
                    <li><a href="{{ route('bookSession') }}">Book Session</a></li>
                    <li class="current">Order Summary</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->
    <div class="container py-5">
        <p>Booking for: <strong>{{ $booking->name }}</strong></p>
        <p>Session Time:
            <strong>{{ \Carbon\Carbon::parse($booking->session_time)->format('l, jS F Y \a\t g:i A') }}</strong>
        </p>
        <p>Amount: <strong>KES {{ number_format($booking->amount, 2) }}</strong></p>
        <div class="alert alert-info mt-3">
            <strong>Pending Order: </strong>This order is still pending until payment is made.<br>
            When ready, you can proceed to make payment for the session booked.
        </div>
        <form id="pesapal-pay-form" method="POST" action="{{ route('pesapal.checkout', $booking->id) }}">
            @csrf
            <button type="submit" class="btn btn-success mt-3">Pay with Pesapal</button>
        </form>
        <div id="pesapal-loading"
            style="display:none;position:fixed;top:0;left:0;width:100vw;height:100vh;background:rgba(255,255,255,0.8);z-index:9999;justify-content:center;align-items:center;">
            <div>
                <span class="spinner-border" role="status" aria-hidden="true"></span>
                <span style="margin-left:10px;">Redirecting to Pesapal...</span>
            </div>
        </div>
        <script>
            document.getElementById('pesapal-pay-form').addEventListener('submit', function() {
                document.getElementById('pesapal-loading').style.display = 'flex';
            });
        </script>
    </div>
@endsection
