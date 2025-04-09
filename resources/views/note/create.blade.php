<x-layout>
    <div class="note-container single-note">
        <h1>Create new note</h1>
        <!-- When submitting this form, route to note.store to store it in the db. -->
        <form action="{{ route('note.store') }}" method="POST" class="note">
            <textarea name="note" rows="10" class="note-body" placeholder="Enter your note here"></textarea>
            <div class="note-buttons">
                <!-- Go back to the note list. -->
                <a href="{{ route('note.index') }}" class="note-cancel-button">Cancel</a>
                <!-- Invoke POST method. -->
                <button class="note-submit-button">Submit</button>
            </div>
        </form>
    </div>
</x-layout>