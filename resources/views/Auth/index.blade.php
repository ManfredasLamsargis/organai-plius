<x-layout>
    <div>
        <div class="body-part-type-box-container">
            @foreach ($notifications as $notification)
                <div class="body-part-type-box">
                    <h3>
                        {{ $notification->date }}
                    </h3>
                    <p>
                        {{ $notification->text }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>