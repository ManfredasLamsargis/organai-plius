@extends('Courier.layout')

@section('content')
    <h2>Delivery #{{ $delivery->id }} Info</h2>

    <p><strong>Pickup:</strong> {{ $delivery->pickupPoint->latitude }}, {{ $delivery->pickupPoint->longitude }}</p>
    <p><strong>Drop:</strong> {{ $delivery->dropPoint->latitude }}, {{ $delivery->dropPoint->longitude }}</p>
    <p><strong>Current Location:</strong> 
        @if($delivery->currentLocation)
            {{ $delivery->currentLocation->latitude }}, {{ $delivery->currentLocation->longitude }}
        @else
            N/A
        @endif
    </p>

    <a href="{{ route('courier.delivery.index') }}">Back to list</a>
@endsection
