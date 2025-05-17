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
        </header>
        <nav>
            <ul>
                <li><a href="{{ route('crypto_wallet.submit') }}">Add crypto wallet</a></li>
                <li><a href="{{ route('body_part.getBodyPartList') }}">View body part list</a></li>
                <li><a href="{{ route('auction.getAuctionList') }}">View auction list</a></li>
            </ul>
        </nav>
    </div>
</body>
</html>
