<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Main Client Page</title>
    @vite(['resources/css/client.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container">
        <header>
            <h1>Client Main page</h1>
            <p>Your central hub for crypto wallet and body part type management.</p>
        </header>

        <nav>
            <ul>
                <li><a href="{{ url('/crypto-wallet') }}">Crypto Wallet</a></li>
                <li><a href="{{ url('/body-part-type') }}">Body Part Types</a></li>
            </ul>
        </nav>
    </div>
</body>
</html>
