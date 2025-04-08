<x-layout>
    <div class="note-container">
        <a href="#" class="new-note-btn">
            New Note
        </a>
        <div class="notes">
            <!-- Note list is provided by the controller -->
            @foreach ($notes as $note)
                <div class="note">
                    <div class="note-body">
                        <!-- display note model's note column -->
                        {{ $note->note }}
                    </div>
                    <div class="note-buttons">
                        <a href="#" class="note-edit-button">View</a>
                        <a href="#" class="note-edit-button">Edit</a>
                        <button class="note-delete-button">Delete</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>