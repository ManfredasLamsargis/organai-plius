<?php

use App\Http\Controllers\BodyPartTypeController;
use App\Http\Controllers\Client\CryptoWalletController;
use App\Http\Controllers\Shared\BodyPartController;
use App\Http\Controllers\Client\AuctionController;
use Illuminate\Support\Facades\Route;

// Courier Subsystem
use App\Http\Controllers\Courier\DeliveryManagingController;
use App\Http\Controllers\Courier\DeliveryReservationController;


Route::get('/', [BodyPartTypeController::class, 'index'])->name('Body Part Types');
Route::resource('body_part_type', BodyPartTypeController::class);

// Courier Subsystem
// Calls from the main view
Route::get('/courier/main', function () {
    return view('Courier.main');
});
Route::get('/courier/deliveries', [DeliveryReservationController::class, 'index'])->name('courier.delivery.index');

// Client part
Route::get('/client-main', [CryptoWalletController::class, 'main']);
Route::resource('crypto_wallet', CryptoWalletController::class);
//Route::get('/crypto-wallet/form', [CryptoWalletController::class, 'getCryptoWalletForm'])
//    ->name('crypto_wallet.getCryptoWalletForm');
Route::resource('body_part', BodyPartController::class);
Route::post('/body-part/buy/{id}', [BodyPartController::class, 'buy'])->name('body_part.buy');
Route::post('/body-part/agree/{id}', [BodyPartController::class, 'agreeToBuy'])->name('body_part.agree');
Route::get('/offers/{id}/auction', [BodyPartController::class, 'redirectToAuction'])->name('body_part.redirectAuction');
Route::post('/auctions/{auction}/check-balance', [AuctionController::class, 'checkBidBalance']);
Route::resource('auctions', AuctionController::class);



