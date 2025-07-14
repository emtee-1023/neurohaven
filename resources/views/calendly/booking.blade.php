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

    <div id="booking-loader"
        style="display:none;position:fixed;top:0;left:0;width:100vw;height:100vh;background:rgba(255,255,255,0.8);z-index:9999;justify-content:center;align-items:center;">
        <div>
            <span class="spinner-border" role="status" aria-hidden="true"></span>
            <span style="margin-left:10px;">Confirming your booking...</span>
        </div>
    </div>

    <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>
    <script>
        window.addEventListener('message', function(e) {
            if (e.data.event === 'calendly.event_scheduled') {
                var eventUri = e.data.payload && e.data.payload.event && e.data.payload.event.uri;
                if (eventUri) {
                    var loader = document.getElementById('booking-loader');
                    if (loader) {
                        loader.style.display = 'flex';
                    }
                    setTimeout(function() {
                        window.location.href = '/booking/fetch-latest?event_uri=' + encodeURIComponent(
                            eventUri);
                    }, 2000);
                }
            }
        });
    </script>
@endsection
