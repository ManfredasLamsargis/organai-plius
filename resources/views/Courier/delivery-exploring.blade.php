@extends('Courier.layout')

@section('content')
    <h2>Delivery List</h2>

    @if($deliveries->isEmpty())
        <p>No deliveries available.</p>
    @else
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>Hash</th>
                    <th>Pickup point</th>
                    <th>Drop point</th>
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
                            <a href="{{ route('courier.delivery.info', ['id' => $delivery->id]) }}">Details</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
