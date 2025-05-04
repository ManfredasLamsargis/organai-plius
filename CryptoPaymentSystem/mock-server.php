<?php
// Run: php -S 127.0.0.1:9000 mock-server.php
header('Content-Type: application/json');

$address = $_GET['address'] ?? '';
$authorized = str_starts_with($address, '0x');
$balance = $authorized ? rand(1, 100000) : 0;

echo json_encode([
    'authorized' => $authorized,
    'balance' => $balance
]);
