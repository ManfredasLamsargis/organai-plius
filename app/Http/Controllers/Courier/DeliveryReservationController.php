<?php

namespace App\Http\Controllers\Courier;

use Illuminate\Http\Request;
use Nette\NotImplementedException;
use App\Http\Controllers\Controller;

class DeliveryReservationController extends Controller
{
    public function index()
    {
        // MANFREDAS_TODO: fetch unreserved deliveries.
        return view('courier.deliveries');
    }

    
}
