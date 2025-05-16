<x-layout>
    <h2>Delivery Started</h2>
    <p><strong>Delivery ID:</strong> {{ $delivery->id }}</p>
    <p><strong>New State:</strong> {{ $delivery->state }}</p>

    <a href="{{ route('delivery.manage') }}">
        <button class="">Back to Management Panel</button>
    </a>
</x-layout>
