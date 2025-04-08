<x-layout>
    <div class="note-container">
        <!-- route navigates to the given page -->
        <a href="{{ route('note.create') }}" class="new-note-btn">
            New Note
        </a>
        <div class="notes">
            <!-- Note list is provided by the controller -->
            @foreach ($notes as $note)
                <div class="note">
                    <div class="note-body">
                        <!-- display note model's note column (Str shrinks to 30 words) -->
                        {{ Str::words($note->note, 30) }}
                    </div>
                    <div class="note-buttons">
                        <a href="{{ route('note.show', $note) }}" class="note-edit-button">View</a>
                        <a href="{{ route('note.edit', $note) }}" class="note-edit-button">Edit</a>
                        <button class="note-delete-button">Delete</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>