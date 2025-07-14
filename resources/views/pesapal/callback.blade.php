@extends('layouts.app')

@section('content')
    @include('partials.nav')
    <!-- Page Title -->
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Confirmation</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('landing') }}">Home</a></li>
                    <li><a href="{{ route('bookSession') }}">Session Booking</a></li>
                    <li class="current">Confirmation</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->
    <div class="container py-5">
        <div class="alert alert-danger">
            <h4>Payment Error</h4>
            <p>{{ $error ?? 'Payment failed or not completed.' }}</p>
        </div>
        <a href="{{ route('bookSession') }}" class="btn btn-primary">Return</a>
    </div>
@endsection
