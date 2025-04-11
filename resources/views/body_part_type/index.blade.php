<x-layout>
    <div>
        <div class="body-part-type-create-button-container">
            <a href="{{ route('body_part_type.create') }}">
                <button class="crud-button create" type="button">Create</button>
            </a>
        </div>
        <div class="body-part-type-box-container">
            @foreach ($bodyPartTypes as $bodyPartType)
                <div class="body-part-type-box">
                    <h3>
                        {{ $bodyPartType->name }}
                    </h3>
                    <p>
                        {{ $bodyPartType->expiration_period_minutes }}
                    </p>
                    <div class="body-part-type-buttons-container">
                        <a href="{{ route('body_part_type.show', $bodyPartType) }}">
                            <button class="crud-button show" type="button">Details</button>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>