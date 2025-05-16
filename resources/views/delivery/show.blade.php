<x-layout>
    <h2>Delivery Details</h2>
    <p>State: {{ $delivery->state }}</p>
    <p>Courier: {{ optional($delivery->responsibleCourier)->name ?? 'N/A' }}</p>
    <p>From: {{ optional($delivery->pickupPoint)->name ?? 'N/A'}}</p>
    <p>To: {{ optional($delivery->dropPoint)->name ?? 'N/A'}}</p>
    <a href="{{ route('deliveries.index') }}">Back to List</a>
</x-layout>
