@extends('Courier.layout')

@section('content')
    @if (session('message'))
        <div class="alert alert-info">
            {{ session('message') }}
        </div>
    @endif

    <h2>Accepted Delivery Route</h2>

    <div id="map" 
        data-pickup-lat="{{ $delivery->pickupPoint->latitude }}" 
        data-pickup-lng="{{ $delivery->pickupPoint->longitude }}"
        data-drop-lat="{{ $delivery->dropPoint->latitude }}" 
        data-drop-lng="{{ $delivery->dropPoint->longitude }}"
        style="height: 400px; width: 100%; margin-bottom: 20px;">
    </div>

    <script>
        const routeCoords = [
            @foreach ($routeCoordinates as $coord)
                [{{ $coord->latitude }}, {{ $coord->longitude }}],
            @endforeach
        ];
    </script>

    <br>
    <a href="{{ route('courier.main') }}">Back main panel</a>
@endsection

@section('scripts')
    @vite(['resources/js/map.js'])

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const el = document.getElementById('map');
            const pickup = [
                parseFloat(el.dataset.pickupLat),
                parseFloat(el.dataset.pickupLng)
            ];
            const drop = [
                parseFloat(el.dataset.dropLat),
                parseFloat(el.dataset.dropLng)
            ];

            if (typeof window.renderMap === 'function') {
                window.renderMap('map', pickup, drop, routeCoords);
            } else {
                console.warn('renderMap is not defined');
            }
        });
    </script>
@endsection
