<x-layout>
    <div class="container">
        <h1>Add Body Part Offer</h1>

        @if(session('message'))
            <div class="alert success">{{ session('message') }}</div>
        @endif

        @if($errors->any())
            <div class="alert error">
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
                <label for="price">Price</label>
                <input type="number" name="price" step="0.01" required>
            </div>

            <div>
                <label for="available_at">Available Date</label>
                <input type="date" name="available_at" required>
            </div>

            <div>
                <label for="description">Description</label>
                <textarea name="description" required></textarea>
            </div>

            <div>
                <label for="body_part_type_id">Body Part Type</label>
                <select name="body_part_type_id" required>
                    @foreach($bodyPartTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="crud-button create">Add Offer</button>
        </form>
    </div>
</x-layout>
