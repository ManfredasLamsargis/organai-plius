<?php

use App\Http\Controllers\Admin\BodyPartTypeController;
use App\Http\Controllers\Admin\DeliveriesController;
use App\Http\Controllers\Admin\SupplierOfferController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\NotificationController;
use App\Http\Controllers\Client\CryptoWalletController;
use App\Http\Controllers\Shared\BodyPartController;
use App\Http\Controllers\Client\AuctionController;
use App\Http\Controllers\Shared\OrderController;
use Illuminate\Support\Facades\Route;

// Courier Subsystem
use App\Http\Controllers\Courier\DeliveryManagingController;
use App\Http\Controllers\Courier\DeliveryReservationController;
use App\Http\Controllers\Courier\DeliveryController;


Route::get('/', [BodyPartTypeController::class, 'index'])->name('Body Part Types');
Route::resource('body_part_type', BodyPartTypeController::class);

// Admin part
Route::resource('supplier-offers', SupplierOfferController::class)->only(['index', 'show']);
Route::post('supplier-offers/{supplier_offer}/accept', [SupplierOfferController::class, 'accept'])->name('supplier-offers.accept');
Route::resource('deliveries', DeliveriesController::class)->only(['index', 'show']);
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/courier/delivery/manage', [DeliveryManagingController::class, 'index'])->name('delivery.manage');
Route::post('/courier/delivery/startDelivery', [DeliveryManagingController::class, 'startDelivery'])->name('delivery.startDelivery');
Route::post('/courier/delivery/finishDelivery', [DeliveryManagingController::class, 'finishDelivery'])->name('delivery.finishDelivery');

// Courier part
Route::get('/courier/main', function () { return view('Courier.main'); })->name('courier.main');
Route::get('/courier/deliveries', [DeliveryReservationController::class, 'index'])->name('courier.delivery.index');
Route::get('/courier/delivery/{id}', [DeliveryReservationController::class, 'show'])->name('courier.delivery.info');
Route::post('/courier/reserve/{id}', [DeliveryReservationController::class, 'reserve'])->name('courier.reserve');
Route::get('/courier/delivery-route/{id}', [DeliveryController::class, 'showRoute'])->name('courier.delivery-route');
Route::get('/courier/delivery-route', [DeliveryController::class, 'showLatestRoute'])->name('courier.delivery-route');

// Client part
Route::get('/client-main', [CryptoWalletController::class, 'main']);
Route::resource('crypto_wallet', CryptoWalletController::class);
Route::get('/crypto_wallet_form', [CryptoWalletController::class, 'create'])->name('crypto_wallet.getCryptoWalletForm');
Route::post('crypto_wallet/create', [CryptoWalletController::class, 'create'])->name('crypto_wallet.submit');
Route::get('/body-part/{id}', [BodyPartController::class, 'show'])->name('body_part.getBodyPart');
//Route::get('/body-part', [BodyPartController::class, 'index'])->name('body_part.getBodyPartList');
Route::get('/crypto-wallet/form', [CryptoWalletController::class, 'getCryptoWalletForm'])->name('crypto_wallet.getCryptoWalletForm');

Route::get('client/body_part', [BodyPartController::class, 'indexClient'])->name('body_part.getBodyPartList');
//Route::get('client/body_part', [BodyPartController::class, 'index'])->name('body_part.getBackToList');

Route::resource('body_part', BodyPartController::class);

Route::post('/body-part/buy/{id}', [BodyPartController::class, 'buy'])->name('body_part.buy');
Route::post('/body-part/agree/{id}', [BodyPartController::class, 'agreeToBuy'])->name('body_part.agree');
Route::get('/offers/{id}/auction', [BodyPartController::class, 'redirectToAuction'])->name('body_part.participateInAuction');
Route::post('/auctions/{auction}/check-balance', [AuctionController::class, 'checkBidBalance']);
Route::resource('auctions', AuctionController::class);
Route::get('/auctions', [AuctionController::class, 'index'])->name('auction.getAuctionList');
Route::get('/auctions/{id}', [AuctionController::class, 'show'])->name('auction.getAuction');

Route::get('/orders', [OrderController::class, 'index'])->name('orders.getOrders');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.getOrder');
Route::put('/orders/{id}/confirm-order', [OrderController::class, 'finishOrder'])->name('orders.confirmOrder');

Route::get('/supplier-main', function() { return view('Supplier.main'); })->name('supplier.home');
Route::get('supplier/body_part', [BodyPartController::class, 'indexSupplier'])->name('body_part.showBodyPartOffers');
Route::post('body_part/create', [BodyPartController::class, 'create'])->name('body_part.addBodyPartOffer');

// Auth
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.showNotifications');
Route::resource('notification', NotificationController::class);
