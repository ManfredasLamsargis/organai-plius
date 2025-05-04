<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\CryptoWallet;

class CryptoWalletController extends Controller
{
    private function connectToMockCryptoProvider(string $address): array
    {
        $response = Http::get('http://127.0.0.1:9000', [
            'address' => $address
        ]);
    
        return $response->json();
    }

    public function main()
    {
        return view('Client.main');
    }

    public function getCryptoWalletForm()
    {
        return $this->create();
    }

    public function create()
    {
        return view('Client.crypto_wallet_form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'address' => 'required|string|max:255'
        ]);
    
        $walletInfo = $this->connectToMockCryptoProvider($data['address']);
    
        CryptoWallet::create([
            'address' => $data['address'],
            'authorized' => $walletInfo['authorized'],
            'balance' => $walletInfo['balance']
        ]);
        
        if (!$walletInfo['authorized']) {
            return redirect()->back()->with('message', 'Wallet address saved, but not authorized.');
        }

        return redirect()->back()->with('message', 'Wallet created and verified.');
    }

    public function processReturnedState(Request $request)
    {
        return response()->json(['status' => 'processed']);
    }

    public function disconnectCryptoWallet()
    {
        return redirect()->back()->with('message', 'Wallet disconnected.');
    }

    public function getBalance()
    {
        return response()->json(['balance' => 100.00]);
    }

    public function checkBalance()
    {
        return $this->getBalance();
    }

    public function performPayment(Request $request)
    {
        return response()->json(['status' => 'payment_successful']);
    }
}
