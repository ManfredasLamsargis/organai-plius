<x-layout>
    <div class="body-part-type-box-container">
        <div class="body-part-type-box info">
            <h1>Order details</h1>
@if (session('error'))
            <div class="error-message" style="padding: 15px 25px; background-color: #e74c3c; color: white; border-radius: 4px; margin-bottom: 30px;">
                {{ session('error') }}
            </div>
        @endif

        <div style="margin-top: 20px; text-align: left;">
            <p><strong>Order ID:</strong> {{ $order->id }}</p>
            <p><strong>Date:</strong> {{ $order->created_at }}</p>
            <p><strong>Price:</strong> {{ number_format($order->total_price, 2) }} €</p>
            <p><strong>State:</strong> 
                @if($order->status->value == 'unpaid')
                    <span style="color: #e74c3c;">Unpaid</span>
                @elseif($order->status->value == 'in_delivery')
                    <span style="color: #3498db;">Delivering</span>
                @elseif($order->status->value == 'completed')
                    <span style="color: #2ecc71;">Finished</span>
                @elseif($order->status->value == 'canceled')
                    <span style="color: #7f8c8d;">Canceled</span>
                @endif
            </p>
            
            @if($order->bodyPartOffer)
                <h3>Body part information</h3>
                <p><strong>Description:</strong> {{ $order->bodyPartOffer->description }}</p>
                <p><strong>Body part type:</strong> {{ $order->bodyPartOffer->bodyPartType->name ?? 'Nenurodyta' }}</p>
            @endif
        </div>

        <div class="body-part-type-buttons-container" style="margin-top: 30px;">
            <a href="{{ route('orders.getOrders') }}">
                <button class="crud-button go-back">Back to order list</button>
            </a>
            
            @if($order->status->value == 'in_delivery')
                <form action="{{ route('orders.confirmOrder', $order->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="crud-button create">
                        Patvirtinti pristatymą
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
</x-layout>