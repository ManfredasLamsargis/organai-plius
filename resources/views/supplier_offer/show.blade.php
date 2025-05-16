<x-layout>
    <h2>{{ $supplier_offer->description }}</h2>
    <p>Price: €{{ $supplier_offer->price }}</p>
    <form action="{{ route('supplier-offers.accept', $supplier_offer) }}" method="POST">
        @csrf
        <button type="submit">Accept Offer</button>
    </form>
    <a href="{{ route('supplier-offers.index') }}">Back to List</a>
</x-layout>
