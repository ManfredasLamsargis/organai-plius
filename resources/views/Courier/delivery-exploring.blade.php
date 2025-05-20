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
        <br>
        <form action="{{ route('courier.delivery.index') }}" method="GET" style="margin-bottom: 1rem;">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">
                Refresh deliveries
            </button>
        </form>
        <br>
        <a href="{{ route('courier.main') }}">Main panel</a>
    @endif
@endsection
