<?php

use App\Http\Controllers\Admin\BodyPartTypeController;
use App\Http\Controllers\Admin\DeliveriesController;
use App\Http\Controllers\Admin\SupplierOfferController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\DeliveryManagingController;
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


Route::resource('supplier-offers', SupplierOfferController::class)->only(['index', 'show']);
Route::post('supplier-offers/{supplier_offer}/accept', [SupplierOfferController::class, 'accept'])->name('supplier-offers.accept');

Route::resource('deliveries', DeliveriesController::class)->only(['index', 'show']);

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

Route::get('/courier/delivery/manage', [DeliveryManagingController::class, 'index'])->name('delivery.manage');
Route::post('/courier/delivery/start', [DeliveryManagingController::class, 'start'])->name('delivery.start');
Route::post('/courier/delivery/finish', [DeliveryManagingController::class, 'finish'])->name('delivery.finish');
