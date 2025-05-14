@extends('Courier.layout')

@section('content')
    <h2>Delivery List</h2>

    @if($deliveries->isEmpty())
        <p>No deliveries available.</p>
    @else
        <ul>
            @foreach ($deliveries as $delivery)
                <li>
                    Delivery #{{ $delivery->id }}<br>
                    Pickup: {{ $delivery->pickupPoint->latitude ?? 'N/A' }}, {{ $delivery->pickupPoint->longitude ?? 'N/A' }}<br>
                    Drop: {{ $delivery->dropPoint->latitude ?? 'N/A' }}, {{ $delivery->dropPoint->longitude ?? 'N/A' }}<br>
                    Current Location: 
                        @if ($delivery->currentLocation)
                            {{ $delivery->currentLocation->latitude }}, {{ $delivery->currentLocation->longitude }}
                        @else
                            N/A
                        @endif
                    <br><br>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
