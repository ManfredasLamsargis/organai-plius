<x-layout>
    <div class="body-part-type-box-container">
        <div class="body-part-type-box info">
            <h1>Pridėti organo pasiūlymą</h1>
            @if(session('message'))
            <div class="success-message">
                {{ session('message') }}
            </div>
        @endif

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
                <label for="price">Kaina (€)</label>
                <br>
                <input type="number" name="price" id="price" step="0.01" required>
            </div>
            
            <div>
                <label for="available_at">Galioja nuo</label>
                <br>
                <input type="date" name="available_at" id="available_at" required>
            </div>
            
            <div>
                <label for="body_part_type_id">Organo tipas</label>
                <br>
                <select name="body_part_type_id" id="body_part_type_id" required>
                    @foreach($bodyPartTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label for="description">Aprašymas</label>
                <br>
                <textarea name="description" id="description" rows="3" required></textarea>
            </div>
            
            <div class="body-part-type-buttons-container">
                <button class="crud-button create" type="submit">Sukurti</button>
                <a href="{{ route('body_part.index') }}">
                    <button class="crud-button cancel" type="button">Atšaukti</button>
                </a>
            </div>
        </form>
    </div>
</div>
</x-layout>