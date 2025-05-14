<x-layout>
    <div class="body-part-type-box-container">
        <div class="body-part-type-box info">
            <h1>Create Crypto Wallet</h1>
            
            @if($errors->any())
                <div class="alert error">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('crypto_wallet.store') }}" method="POST">
                @csrf
                <div>
                    <label for="address">Wallet Address</label>
                    <br>
                    <input type="text" name="address" id="address" required>
                </div>
                <div class="body-part-type-buttons-container">
                    <button type="submit" class="crud-button create">Create</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
