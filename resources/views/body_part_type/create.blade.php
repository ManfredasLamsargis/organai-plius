<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Create Body Part Type</title>
</head>
<body>
    <div>
        <h1>
            Create Body Part Type
        </h1>
        <form action="{{ route('body_part_type.store') }}" method="POST">
            @csrf
            <div>
                <label>Name</label>
                <textarea type="text" id="name" required></textarea>
            </div>
            <div>
                <label>Expiration period</label>
                <textarea type="text" id="expiration_period" required></textarea>
            </div>
            <div>
                <label>Description</label>
                <textarea type="text" id="description" rows="3" required></textarea>
            </div>
            <button type="submit">Create</button>
        </form>
    </div>
</body>
</html>