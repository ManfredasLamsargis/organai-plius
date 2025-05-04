<?php

namespace App\Boundaries\Client;

use Illuminate\Support\Facades\Http;

class CryptoProviderAPI
{
    /**
     * Sends wallet address to external provider and returns its authorization status and balance.
     *
     * @param string $address
     * @return array
     */
    public function sendCryptoWalletData(string $address): array
    {
        $response = Http::get('http://127.0.0.1:9000', [
            'address' => $address
        ]);

        return $response->ok()
            ? $response->json()
            : ['authorized' => false, 'balance' => 0];
    }
}
