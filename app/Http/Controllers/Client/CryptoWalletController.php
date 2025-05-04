<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CryptoWalletController extends Controller
{
    public function main()
    {
        return view('Client.main');
    }

    public function openCryptoWalletForm()
    {
        return view('Client.crypto_wallet_form');
    }

    public function store(Request $request)
    {
        return redirect()->back()->with('message', 'Wallet stored successfully.');
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
