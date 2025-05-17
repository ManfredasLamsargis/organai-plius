<x-layout>
    <div class="body-part-type-box info">
        <h1>Body Part Offer Details</h1>
        <p><strong>Price:</strong> €{{ number_format($offer->price, 2) }}</p>
        <p><strong>Available at:</strong> {{ $offer->available_at }}</p>
        <p><strong>Description:</strong> {{ $offer->description }}</p>
        <p><strong>Body Part Type:</strong> {{ $offer->bodyPartType->name ?? 'N/A' }}</p>

        <div class="body-part-type-buttons-container" style="margin-top: 20px;">
            <!-- Place a bid and run the auction -->
            <a href="{{ route('body_part.redirectToAuction', $offer->id) }}">
                <button class="crud-button edit">Place bid</button>
            </a>

            <!-- Buy body part immediately -->
            <form 
                action="{{ route('body_part.buy', $offer->id) }}" 
                method="POST" 
                style="display:inline;"
            >
                @csrf
                <button type="submit" class="crud-button create">Buy now!</button>
            </form>
        </div>
        @if(session('needsConfirmation') && session('offerId') == $offer->id)
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    if (confirm('Do you agree to buy this body part for €{{ number_format($offer->price * 1.5, 2) }}?')) {
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = '/body-part/agree/{{ session('offerId') }}';

                        const csrf = document.createElement('input');
                        csrf.type = 'hidden';
                        csrf.name = '_token';
                        csrf.value = '{{ csrf_token() }}';

                        form.appendChild(csrf);
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            </script>
        @endif

        <!-- <a href="{{ url()->previous() }}"> -->
        <a href="{{ "/body_part" }}">
            <button class="crud-button go-back">Go Back</button>
        </a>
    </div>
</x-layout>
