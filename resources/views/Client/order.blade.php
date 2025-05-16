<x-layout>
    <div class="body-part-type-box-container">
        <div class="body-part-type-box info">
            <h1>Užsakymo detalės</h1>
@if (session('error'))
            <div class="error-message" style="padding: 15px 25px; background-color: #e74c3c; color: white; border-radius: 4px; margin-bottom: 30px;">
                {{ session('error') }}
            </div>
        @endif

        <div style="margin-top: 20px; text-align: left;">
            <p><strong>Užsakymo ID:</strong> {{ $order->id }}</p>
            <p><strong>Data:</strong> {{ $order->created_at }}</p>
            <p><strong>Kaina:</strong> {{ number_format($order->total_price, 2) }} €</p>
            <p><strong>Būsena:</strong> 
                @if($order->status->value == 'unpaid')
                    <span style="color: #e74c3c;">Neapmokėtas</span>
                @elseif($order->status->value == 'in_delivery')
                    <span style="color: #3498db;">Pristatomas</span>
                @elseif($order->status->value == 'completed')
                    <span style="color: #2ecc71;">Užbaigtas</span>
                @elseif($order->status->value == 'canceled')
                    <span style="color: #7f8c8d;">Atšauktas</span>
                @endif
            </p>
            
            @if($order->bodyPartOffer)
                <h3>Organo informacija</h3>
                <p><strong>Aprašymas:</strong> {{ $order->bodyPartOffer->description }}</p>
                <p><strong>Organo tipas:</strong> {{ $order->bodyPartOffer->bodyPartType->name ?? 'Nenurodyta' }}</p>
            @endif
        </div>

        <div class="body-part-type-buttons-container" style="margin-top: 30px;">
            <a href="{{ route('orders.index') }}">
                <button class="crud-button go-back">Grįžti į sąrašą</button>
            </a>
            
            @if($order->status->value == 'in_delivery')
                <form action="{{ route('orders.confirm-delivery', $order->id) }}" method="POST" style="display: inline;">
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