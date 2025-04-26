<x-layout>
    <div class="body-part-type-box-container">
        <div class="body-part-type-box info">
            <h1>Edit Body Part Type</h1>
            <form action="{{ route('body_part_type.update', $bodyPartType->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div>
                    <label for="name">Name</label>
                    <br>
                    <textarea name="name" id="name" required>{{ $bodyPartType->name }}</textarea>
                </div>
                <div>
                    <label for="expiration_period_minutes">Expiration Period</label>
                    <br>
                    <input type="number" name="expiration_period_minutes" id="expiration_period_minutes" value="{{ $bodyPartType->expiration_period_minutes }}" required>
                </div>
                <div>
                    <label for="description">Description</label>
                    <br>
                    <textarea name="description" id="description" rows="3" required>{{ $bodyPartType->description }}</textarea>
                </div>
                <button class="crud-button update" type="submit">Update</button>
                <button class="crud-button cancel" type="button" onclick="history.back()">Cancel</button>
            </form>
        </div>
    </div>    
</x-layout>
