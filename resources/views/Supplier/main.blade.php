<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Supplier page</title>
    @vite(['resources/css/client.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container">
        <header>
            <h1>Supplier Main page</h1>
        </header>
        <nav>
            <ul>
                <li><a href="{{ route('body_part.showBodyPartOffers') }}">My body part offers</a></li>
                <li><a href="{{ route('body_part.addBodyPartOffer') }}">Add body part offer</a></li>
                <li><a href="{{ route('notifications.showNotifications') }}">Messages</a></li>
            </ul>
        </nav>
    </div>
</body>
</html>