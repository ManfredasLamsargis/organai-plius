<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Courier Panel</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 font-sans">

    @if(session()->has('message'))
        <div class="success-message">
            {{ session('message') }}
        </div>
    @endif

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Courier Subsystem</h1>

        @yield('content')
    </div>

    @yield('scripts')
</body>
</html>
