<?php

namespace App\Http\Controllers\Courier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Boundaries\Courier\WorldMapPlatformAPI;
use Nette\NotImplementedException;

class DeliveryManagingController extends Controller
{
    public function index() 
    {
        throw new NotImplementedException("TODO: Manfredas Lamsargis");
    }

    public function startDelivery()
    {
        throw new NotImplementedException("TODO: Julius Barauskas");
    }

    public function finishDelivery()
    {
        throw new NotImplementedException("TODO: Julius Barauskas");
    }

    public function cancelDelivery()
    {
        throw new NotImplementedException("TODO: Julius Barauskas");
    }

    public function viewDeliveryRoute()
    {
        throw new NotImplementedException("TODO: Manfredas Lamsargis");
    }

    public function refreshDeliveryRouteMap()
    {
        throw new NotImplementedException("TODO: Manfredas Lamsargis");
    }
}
