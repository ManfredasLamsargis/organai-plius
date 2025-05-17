@extends('Courier.layout')

@section('content')
    @if (session('status'))
        <div class="alert alert-info">
            {{ session('status') }}
        </div>
    @endif
    <h2>Delivery Hash: {{ $delivery->id }}</h2>

    <p><strong>Pickup point:</strong> {{ $delivery->pickupPoint->latitude }}, {{ $delivery->pickupPoint->longitude }}</p>
    <p><strong>Drop point:</strong> {{ $delivery->dropPoint->latitude }}, {{ $delivery->dropPoint->longitude }}</p>

    <div id="map" 
        data-pickup-lat="{{ $delivery->pickupPoint->latitude }}" 
        data-pickup-lng="{{ $delivery->pickupPoint->longitude }}"
        data-drop-lat="{{ $delivery->dropPoint->latitude }}" 
        data-drop-lng="{{ $delivery->dropPoint->longitude }}"
        style="height: 400px; width: 100%; margin-bottom: 20px;">
    </div>

    <form action="{{ route('courier.reserve', ['id' => $delivery->id]) }}" method="POST">
        @csrf
        <button type="submit">Accept</button>
    </form>

    <br>
    <a href="{{ route('courier.delivery.index') }}">Back to list</a>
@endsection

@section('scripts')
    @vite(['resources/js/map.js'])
@endsection
