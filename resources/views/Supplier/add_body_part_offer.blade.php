<x-layout>
    <div class="body-part-type-box-container">
        <div class="body-part-type-box info">
            <h1>Add body part offer</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('body_part.store') }}" method="POST">
            @csrf
            <div>
                <label for="price">Price (€)</label>
                <br>
                <input type="number" name="price" id="price" step="0.01" required>
            </div>
            
            <div>
                <label for="available_at">Available at</label>
                <br>
                <input type="date" name="available_at" id="available_at" required>
            </div>
            
            <div>
                <label for="body_part_type_id">Body part type</label>
                <br>
                <select name="body_part_type_id" id="body_part_type_id" required>
                    @foreach($bodyPartTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label for="description">Description</label>
                <br>
                <textarea name="description" id="description" rows="3" required></textarea>
            </div>
            
            <div class="body-part-type-buttons-container">
                <button class="crud-button create" type="submit">Create</button>
            </div>
        </form>
    </div>
</div>
</x-layout>