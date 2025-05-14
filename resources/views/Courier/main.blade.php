@extends('Courier.layout')

@section('content')
    <p>Welcome to the courier panel!</p>

    <form action="{{ route('courier.delivery.index') }}" method="GET">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            View Deliveries
        </button>
    </form>
@endsection
