@extends('Courier.layout')

@section('content')
    <p>Welcome to the courier panel!</p>
    @if (session('message'))
        <div class="alert alert-info">
            {{ session('message') }}
        </div>
    @endif
    <!-- MainCourierView::viewDeliveries() -->
    <form action="{{ route('courier.delivery.index') }}" method="GET">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Available Deliveries
        </button>
    </form>
    <!-- MainCourierView::viewDeliveryRoute() -->
    <form action="{{ route('courier.delivery-route') }}" method="GET">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Delivery Route
        </button>
    </form>
    <!-- MainCourierView::manageDelivery() -->
    <form action="{{ route('delivery.manage') }}" method="GET">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Manage Delivery
        </button>
    </form>
@endsection
