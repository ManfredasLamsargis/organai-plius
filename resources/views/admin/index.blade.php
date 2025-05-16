<x-layout>
    <h1>Admin Dashboard</h1>

    <div class="admin-links">
        <div>
            <a href="{{ route('supplier-offers.index') }}">
                <button class="">View Supplier Offers</button>
            </a>
        </div>

        <div>
            <a href="{{ route('deliveries.index') }}">
                <button class="">View Deliveries</button>
            </a>
        </div>
    </div>
</x-layout>
