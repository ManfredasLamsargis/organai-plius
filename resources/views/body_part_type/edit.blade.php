<div>
    <h1>Edit Body Part Type</h1>

    <form action="{{ route('body_part_type.update', $bodyPartType->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Name</label>
            <textarea name="name" id="name" required>{{ $bodyPartType->name }}</textarea>
        </div>

        <div>
            <label for="expiration_period_minutes">Expiration Period</label>
            <input type="number" name="expiration_period_minutes" id="expiration_period_minutes" value="{{ $bodyPartType->expiration_period_minutes }}" required>
        </div>

        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="3" required>{{ $bodyPartType->description }}</textarea>
        </div>

        <button type="submit">Update</button>
    </form>
</div>
