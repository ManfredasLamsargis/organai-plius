<x-layout>
    <div class="body-part-type-box-container">
        <div class="body-part-type-box info">
            <h3>
                {{ $bodyPartType->name }}
            </h3>
            <p>
                {{ $bodyPartType->description }}
            </p>
            <p>
                {{ $bodyPartType->expiration_period_minutes }}
            </p>
            <div class="body-part-type-buttons-container">
                <a href="{{ route('body_part_type.index') }}">
                    <button class="crud-button go-back" type="button">Back</button>
                </a>
                <a href="{{ route('body_part_type.edit', $bodyPartType) }}">
                    <button class="crud-button edit" type="button">Edit</button>
                </a>
                <form action="{{ route('body_part_type.destroy', $bodyPartType) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this body part type?');">
                    @csrf
                    @method('DELETE')
                    <button class="crud-button delete" type="submit">Delete</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>