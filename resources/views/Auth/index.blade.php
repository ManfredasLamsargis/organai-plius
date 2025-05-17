<x-layout>
    <div>
        <div class="body-part-type-box-container">
            @foreach ($messages as $message)
                <div class="body-part-type-box">
                    <h3>
                        {{ $message->date }}
                    </h3>
                    <p>
                        {{ $message->text }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>