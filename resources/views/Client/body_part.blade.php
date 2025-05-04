<x-layout>
    <div class="body-part-type-box info">
        <h1>Body Part Offer Details</h1>

        <p><strong>Price:</strong> €{{ number_format($offer->price, 2) }}</p>
        <p><strong>Available at:</strong> {{ $offer->available_at }}</p>
        <p><strong>Description:</strong> {{ $offer->description }}</p>
        <p><strong>Body Part Type:</strong> {{ $offer->bodyPartType->name ?? 'N/A' }}</p>

        <div class="body-part-type-buttons-container" style="margin-top: 20px;">
            <button class="crud-button edit">Place bid</button>
            <button class="crud-button create">Buy now!</button>
        </div>

        <a href="{{ url()->previous() }}">
            <button class="crud-button go-back">Go Back</button>
        </a>
    </div>
</x-layout>
