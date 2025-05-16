<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tiekėjo puslapis</title>
    @vite(['resources/css/client.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container">
        <header>
            <h1>Tiekėjo pagrindinis puslapis</h1>
        </header>
        <nav>
            <ul>
                <li><a href="{{ route('body_part.index') }}">Mano organo pasiūlymai</a></li>
                <li><a href="{{ route('body_part.create') }}">Pridėti naują organo pasiūlymą</a></li>
            </ul>
        </nav>
    </div>
</body>
</html>