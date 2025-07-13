@extends('layouts.app')

@section('title', 'Book Your Session')

@section('content')
    @include('partials.nav')
    <!-- Page Title -->
    <div class="page-title">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0">Book Session</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('landing') }}">Home</a></li>
                    <li class="current">Session Booking</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <div style="min-width:320px;height:700px;" class="calendly-inline-widget" data-url="{{ $embedUrl }}">
    </div>

    <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>
@endsection
