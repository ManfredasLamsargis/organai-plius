<?php

use App\Http\Controllers\BodyPartTypeController;
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