<x-layout>
    @if (session('message') || isset($message))
        <div class="alert alert-success" id="success-message">
            {{ session('message') ?? $message }}
        </div>

        <script>
            // Auto-hide message after 3 seconds (3000 ms)
            setTimeout(function() {
                let msg = document.getElementById('success-message');
                if (msg) {
                    msg.style.display = 'none';
                }
            }, 2000);
        </script>
    @endif
    <h1>Supplier Offers</h1>
    @foreach ($offers as $offer)
        <div>
            <p>{{ $offer->description }} - €{{ $offer->price }}</p>
            <a href="{{ route('supplier-offers.show', $offer) }}">Details</a>

        </div>
    @endforeach
    <br>
    <a href="https://youtu.be/xvFZjo5PgG0?si=dfB5X80KZC5IkEem">
        <button type="button" class="">Perform market analysis</button>
    </a>
</x-layout>
