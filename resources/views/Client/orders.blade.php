<x-layout>
    <div class="body-part-type-box-container">
        <div class="body-part-type-box info" style="border: none;">
            <h1>Mano užsakymai</h1>


        @if (session('error'))
            <div class="error-message" style="padding: 15px 25px; background-color: #e74c3c; color: white; border-radius: 4px; margin-bottom: 30px;">
                {{ session('error') }}
            </div>
        @endif

        @if($orders->isEmpty())
            <p>Jūs dar neturite jokių užsakymų.</p>
        @else
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
                <thead>
                    <tr style="background-color: #f2f2f2;">
                        <th style="padding: 12px; border: 1px solid #ddd;">Užsakymo ID</th>
                        <th style="padding: 12px; border: 1px solid #ddd;">Data</th>
                        <th style="padding: 12px; border: 1px solid #ddd;">Kaina</th>
                        <th style="padding: 12px; border: 1px solid #ddd;">Būsena</th>
                        <th style="padding: 12px; border: 1px solid #ddd;">Veiksmai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr style="text-align: center;">
                            <td style="padding: 12px; border: 1px solid #ddd;">{{ $order->id }}</td>
                            <td style="padding: 12px; border: 1px solid #ddd;">{{ $order->created_at }}</td>
                            <td style="padding: 12px; border: 1px solid #ddd;">{{ number_format($order->total_price, 2) }} €</td>
                            <td style="padding: 12px; border: 1px solid #ddd;">
                                @if($order->status->value == 'unpaid')
                                    <span style="color: #e74c3c;">Neapmokėtas</span>
                                @elseif($order->status->value == 'in_delivery')
                                    <span style="color: #3498db;">Pristatomas</span>
                                @elseif($order->status->value == 'completed')
                                    <span style="color: #2ecc71;">Užbaigtas</span>
                                @elseif($order->status->value == 'canceled')
                                    <span style="color: #7f8c8d;">Atšauktas</span>
                                @endif
                            </td>
                            <td style="padding: 12px; border: 1px solid #ddd;">
                                <a href="{{ route('orders.show', $order->id) }}">
                                    <button class="crud-button show">Detalės</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
</x-layout>