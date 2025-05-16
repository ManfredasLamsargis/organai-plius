<x-layout>
    <h2>Manage Delivery</h2>

    @if (!$delivery)
        <script>
            window.addEventListener('DOMContentLoaded', function () {
                alert('You currently have no assigned delivery to manage.');
            });
        </script>
    @else
        <p><strong>Delivery ID:</strong> {{ $delivery->id }}</p>
        <p><strong>Delivery State:</strong> {{ $delivery->state }}</p>
        <p><strong>Drop-off Location:</strong> {{ $delivery->drop_point_id }}</p>

        <form method="POST" action="{{ route('delivery.start') }}">
            @csrf
            <input type="hidden" name="delivery_id" value="{{ $delivery->id }}">
            <button type="submit" class="">Start Delivery</button>
        </form>

        <form method="POST" action="{{ route('delivery.finish') }}">
            @csrf
            <input type="hidden" name="delivery_id" value="{{ $delivery->id }}">
            <button type="submit" class="">Finish Delivery</button>
        </form>
        <a href="https://youtu.be/xvFZjo5PgG0?si=dfB5X80KZC5IkEem">
        <button type="button" class="">Cancel</button>
    </a>
    @endif
</x-layout>
