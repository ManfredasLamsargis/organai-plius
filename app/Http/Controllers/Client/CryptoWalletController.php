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
        // 6
        $data = $request->validate([
            'address' => 'required|string|max:255'
        ]);
        
        // 7
        $wallet = CryptoWallet::create([
            'address' => $data['address'],
            'authorized' => false,
            'balance' => 0
        ]);
    
        $provider = new CryptoProviderAPI();
        // 9
        $walletInfo = $provider->sendCryptoWalletData($wallet->address);

        if ($walletInfo['authorized']) 
        {
            // 13
            $wallet->update([
                'authorized' => true,
                'balance' => $walletInfo['balance']
            ]);
    
            return redirect()->back()->with('message', 'Wallet created and verified.');
        }
    
        return redirect()->back()->with('message', 'Wallet address saved, but not authorized.');
    }

    public static function getBalance($id, $amount = -1): bool|float
    {
        $wallet = CryptoWallet::findOrFail($id);
    
        if ($amount == -1) {
            return $wallet->balance;
        }
    
        return self::checkBalance($wallet, $amount);
    }
    
    private static function checkBalance(CryptoWallet $wallet, float $amount): bool
    {
        return $wallet->balance >= $amount;
    }

    public static function performPayment(float $amount)
    {
        $provider = new CryptoProviderAPI();
        return $provider->sendPaymentRequest($amount);
    }
}
