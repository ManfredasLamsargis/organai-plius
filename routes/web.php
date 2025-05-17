<?php

use App\Http\Controllers\BodyPartTypeController;
use App\Http\Controllers\Client\CryptoWalletController;
use App\Http\Controllers\Shared\BodyPartController;
use App\Http\Controllers\Client\AuctionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [BodyPartTypeController::class, 'index'])->name('Body Part Types');
Route::resource('body_part_type', BodyPartTypeController::class);
// Client part
Route::get('/client-main', [CryptoWalletController::class, 'main']);
Route::resource('crypto_wallet', CryptoWalletController::class);
Route::post('crypto_wallet/create', [CryptoWalletController::class, 'create'])->name('crypto_wallet.submit');
Route::get('/body-part/{id}', [BodyPartController::class, 'show'])->name('body_part.getBodyPart');
Route::get('/body-part', [BodyPartController::class, 'index'])->name('body_part.getBodyPartList');
Route::get('/crypto-wallet/form', [CryptoWalletController::class, 'getCryptoWalletForm'])->name('crypto_wallet.getCryptoWalletForm');
Route::resource('body_part', BodyPartController::class);
Route::post('/body-part/buy/{id}', [BodyPartController::class, 'buy'])->name('body_part.buy');
Route::post('/body-part/agree/{id}', [BodyPartController::class, 'agreeToBuy'])->name('body_part.agree');
Route::get('/offers/{id}/auction', [BodyPartController::class, 'redirectToAuction'])->name('body_part.redirectToAuction');
Route::post('/auctions/{auction}/check-balance', [AuctionController::class, 'checkBidBalance']);
Route::resource('auctions', AuctionController::class);
Route::get('/auctions', [AuctionController::class, 'index'])->name('auction.getAuctionList');
Route::get('/auctions/{id}', [AuctionController::class, 'show'])->name('auction.getAuction');



