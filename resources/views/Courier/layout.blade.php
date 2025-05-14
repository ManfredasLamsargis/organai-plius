<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Courier Panel</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">

    <div class="container mx-auto p-4">
        {{-- Navbar or header can go here --}}
        <h1 class="text-2xl font-bold mb-4">Courier Subsystem</h1>

        @yield('content')
    </div>

</body>
</html>
