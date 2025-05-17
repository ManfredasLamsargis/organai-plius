<?php

use App\Http\Controllers\Admin\BodyPartTypeController;
use App\Http\Controllers\Admin\DeliveriesController;
use App\Http\Controllers\Admin\SupplierOfferController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Client\CryptoWalletController;
use App\Http\Controllers\Shared\BodyPartController;
use App\Http\Controllers\Client\AuctionController;
use App\Http\Controllers\Shared\OrderController;
use Illuminate\Support\Facades\Route;

// Courier Subsystem
use App\Http\Controllers\Courier\DeliveryManagingController;
use App\Http\Controllers\Courier\DeliveryReservationController;


Route::get('/', [BodyPartTypeController::class, 'index'])->name('Body Part Types');
Route::resource('body_part_type', BodyPartTypeController::class);

// Admin part
Route::resource('supplier-offers', SupplierOfferController::class)->only(['index', 'show']);
Route::post('supplier-offers/{supplier_offer}/accept', [SupplierOfferController::class, 'accept'])->name('supplier-offers.accept');
Route::resource('deliveries', DeliveriesController::class)->only(['index', 'show']);
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/courier/delivery/manage', [DeliveryManagingController::class, 'index'])->name('delivery.manage');
Route::post('/courier/delivery/start', [DeliveryManagingController::class, 'start'])->name('delivery.start');
Route::post('/courier/delivery/finish', [DeliveryManagingController::class, 'finish'])->name('delivery.finish');

// Courier part
Route::get('/courier/main', function () { return view('Courier.main'); });
Route::get('/courier/deliveries', [DeliveryReservationController::class, 'index'])->name('courier.delivery.index');
Route::get('/courier/delivery/{id}', [DeliveryReservationController::class, 'show'])->name('courier.delivery.info');
Route::post('/courier/reserve/{id}', [DeliveryReservationController::class, 'reserve'])->name('courier.reserve');

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

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
Route::put('/orders/{id}/confirm-delivery', [OrderController::class, 'confirmDelivery'])->name('orders.confirm-delivery');

Route::get('/supplier-main', function() { return view('Supplier.main'); })->name('supplier.home');