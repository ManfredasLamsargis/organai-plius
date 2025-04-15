<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Create Body Part Type</title>
</head>
<body>
    <!-- Error handling for debugging. -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <x-layout>
    <div class="body-part-type-box-container">
        <div class="body-part-type-box info">
            <h1>Create Body Part Type</h1>
            <form action="{{ route('body_part_type.store') }}" method="POST">
                @csrf
                <div>
                    <label for="name">Name</label>
                    <br>
                    <textarea name="name" id="name" required></textarea>
                </div>
                <div>
                    <label for="expiration_period_minutes">Expiration Period</label>
                    <br>
                    <input type="number" name="expiration_period_minutes" id="expiration_period_minutes" required>
                </div>
                <div>
                    <label for="description">Description</label>
                    <br>
                    <textarea name="description" id="description" rows="3" required></textarea>
                </div>
                <button class="crud-button create" type="submit">Create</button>
            </form>
        </div>
    </div>
</x-layout>

</body>
</html>