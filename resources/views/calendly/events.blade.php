@extends('layouts.app')

@section('title', 'Your Calendly Event Types')

@section('content')
    <h1>Your Event Types</h1>

    @if ($events && count($events))
        <ul>
            @foreach ($events as $event)
                <li>
                    <strong>{{ $event['name'] }}</strong><br>
                    <p>{{ $event['description_plain'] }}</p>
                    <a href="{{ 'https://calendly.com' . parse_url($event['uri'], PHP_URL_PATH) }}" target="_blank">Bookable
                        Link</a>
                </li>
            @endforeach
        </ul>
    @else
        <p>No event types found.</p>
    @endif
@endsection
