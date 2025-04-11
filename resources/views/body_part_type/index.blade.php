<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Body Part Types</title>
    </head>
    <body>
        <div>
            <a href="{{ route('body_part_type.create') }}">Create</a>
        </div>
        <div>
            @foreach ($bodyPartTypes as $bodyPartType)
                <div>
                    <h3>
                        {{ $bodyPartType->name }}
                    </h3>
                    <p>
                        {{ $bodyPartType->expiration_period_minutes }}
                    </p>
                    <a href="{{ route('body_part_type.edit', $bodyPartType) }}"></a>
                    <form action="{{ route('body_part_type.destroy', $bodyPartType) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    </body>
</html>