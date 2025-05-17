<?php
// Run: php -S 127.0.0.1:9000 mock-server.php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/payment') {
    $input = json_decode(file_get_contents('php://input'), true);
    $amount = $input['amount'] ?? 0;

    echo json_encode([
        'success' => $amount > 0,
        'message' => $amount > 0 ? 'Payment successful' : 'Invalid amount'
    ]);
    return;
}

$address = $_GET['address'] ?? '';
$authorized = str_starts_with($address, '0x');
$balance = $authorized ? rand(1, 100000) : 0;

echo json_encode([
    'authorized' => $authorized,
    'balance' => $balance
]);
