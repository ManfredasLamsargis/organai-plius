<x-layout>
    <div class="body-part-type-box-container">
        <div class="body-part-type-box info" style="border: none;">
            <h1>All Auctions</h1>

            <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
                <thead>
                    <tr style="background-color: #f2f2f2;">
                        <th style="padding: 12px; border: 1px solid #ddd;">Minimum Bid (€)</th>
                        <th style="padding: 12px; border: 1px solid #ddd;">Status</th>
                        <th style="padding: 12px; border: 1px solid #ddd;">Ends At</th>
                        <th style="padding: 12px; border: 1px solid #ddd;">Body Part</th>
                        <th style="padding: 12px; border: 1px solid #ddd;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($auctions as $auction)
                        <tr style="text-align: center;">
                            <td style="padding: 12px; border: 1px solid #ddd;">
                                €{{ number_format($auction->minimum_bid, 2) }}
                            </td>
                            <td style="padding: 12px; border: 1px solid #ddd;">
                                {{ $auction->status->value }}
                            </td>
                            <td style="padding: 12px; border: 1px solid #ddd;">
                                {{ $auction->end_time->addHours(3)->format('Y-m-d H:i') }}
                            </td>
                            <td style="padding: 12px; border: 1px solid #ddd;">
                                {{ $auction->bodyPartOffer->description ?? 'N/A' }}
                            </td>
                            <td style="padding: 12px; border: 1px solid #ddd;">
                                <a href="{{ route('auction.getAuction', $auction->id) }}">
                                    <button class="crud-button show">View Auction</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
