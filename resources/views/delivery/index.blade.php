<x-layout>
    <h1>Organ Deliveries</h1>
    @foreach($deliveries as $delivery)
        <div>
            <p>State: {{ $delivery->state }}</p>
            <a href="{{ route('deliveries.show', $delivery) }}">View Details</a>
        </div>
    @endforeach
</x-layout>
