<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CryptoWallet;
use App\Boundaries\Client\CryptoProviderAPI;

class CryptoWalletController extends Controller
{
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
    
        $wallet = CryptoWallet::create([
            'address' => $data['address'],
            'authorized' => false,
            'balance' => 0
        ]);
    
        $provider = new CryptoProviderAPI();
        $walletInfo = $provider->sendCryptoWalletData($wallet->address);

        if ($walletInfo['authorized']) {
            $wallet->update([
                'authorized' => true,
                'balance' => $walletInfo['balance']
            ]);
    
            return redirect()->back()->with('message', 'Wallet created and verified.');
        }
    
        return redirect()->back()->with('message', 'Wallet address saved, but not authorized.');
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
