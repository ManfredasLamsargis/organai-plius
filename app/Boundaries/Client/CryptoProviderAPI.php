<?php

namespace App\Boundaries\Client;

use Illuminate\Support\Facades\Http;

class CryptoProviderAPI
{
    public function sendCryptoWalletData(string $address): array
    {
        $response = Http::get('http://127.0.0.1:8000', [
            'address' => $address
        ]);

        return $response->ok()
            ? $response->json()
            : ['authorized' => false, 'balance' => 0];
    }

    public function sendPaymentRequest(float $amount): array
    {
        \Log::info('Sending payment request with amount: ' . $amount);
        
        $response = Http::post('http://127.0.0.1:8000/payment', [
            'amount' => $amount
        ]);

        return $response->ok()
            ? $response->json()
            : ['success' => false, 'message' => 'Payment failed'];
    }
}
