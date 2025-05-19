<x-layout>
    <div class="body-part-type-box info">
        <h1>Auction Details</h1>

        <p><strong>Minimum Bid:</strong> {{ $auction->minimum_bid }}</p>

        <h3>Body Part Offer:</h3>
        @if($auction->bodyPartOffer)
            <p><strong>Description:</strong> {{ $auction->bodyPartOffer->description }}</p>
            <p><strong>Price:</strong> {{ $auction->bodyPartOffer->price }}</p>
            @if($auction->status->value == "active")
            <p style="color: green;"><strong>ACTIVE</strong></p>
            @endif
            <p style="padding: 12px; border: 1px solid #ddd;">
            <strong>Auction ends at:</strong> {{ $auction->end_time->addHours(3)->format('Y-m-d H:i') }}
            </p>
        @else
            <p>No associated offer found.</p>
        @endif

        <h3>Place bid</h3>
        <form id="bidForm" method="POST" style="margin-top: 20px;">
            @csrf
            <label for="bidAmount"><strong>Amount (€):</strong></label>
            <input 
                type="number"
                name="bid_amount"
                id="bidAmount"
                min="{{ $auction->minimum_bid }}"
                step="0.01"
                required
                style="margin-left: 10px;"
            >
            <button type="button" onclick="placeBid()" class="crud-button create">Place bid</button>
        </form>

        <script>
            async function placeBid() 
            {
                const bid = parseFloat(document.getElementById('bidAmount').value);
                if (!bid) 
                {
                    alert('Please enter a valid amount.');
                    return false;
                }

                const confirmResult = confirm(`You are about to place a €${bid} bid. This action cannot be canceled. Continue?`);

                if (!confirmResult)
                {
                    return false;
                }

                const response = await fetch(`/auctions/{{ $auction->id }}/check-balance`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({ bid_amount: bid })
                });

                const result = await response.json();
                alert(result.message || (result.enough ? 'Success' : 'Something went wrong.'));
            }
        </script>

        @php
            $cameFromAuctionList = str_contains(url()->previous(), route('auction.getAuctionList'));
        @endphp

        @if($cameFromAuctionList)
            <a href="{{ url()->previous() }}">
                <button class="crud-button go-back">Go Back</button>
            </a>
        @endif

    </div>
</x-layout>
