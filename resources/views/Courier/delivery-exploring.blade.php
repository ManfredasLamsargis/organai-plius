@extends('Courier.layout')

@section('content')
    <h2>Delivery List</h2>

    @if($deliveries->isEmpty())
        <p>No deliveries available.</p>
    @else
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pickup (Lat, Lng)</th>
                    <th>Drop (Lat, Lng)</th>
                    <th>Current Location (Lat, Lng)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deliveries as $delivery)
                    <tr>
                        <td>{{ $delivery->id }}</td>
                        <td>{{ $delivery->pickupPoint->latitude ?? 'N/A' }}, {{ $delivery->pickupPoint->longitude ?? 'N/A' }}</td>
                        <td>{{ $delivery->dropPoint->latitude ?? 'N/A' }}, {{ $delivery->dropPoint->longitude ?? 'N/A' }}</td>
                        <td>
                            @if ($delivery->currentLocation)
                                {{ $delivery->currentLocation->latitude }}, {{ $delivery->currentLocation->longitude }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('courier.delivery.info', ['id' => $delivery->id]) }}">Details</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
