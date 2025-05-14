<?php

namespace App\Boundaries\Courier;

use Nette\NotImplementedException;

class WorldMapPlatformAPI 
{
  public function getRouteDisplay() 
  {
    throw new NotImplementedException();
  }

  public function getCurrentLocation()
  {
    throw new NotImplementedException();
  }

  public function updateRoutePath()
  {
    throw new NotImplementedException();
  }

  public function loadAvailadbleRoadData()
  {
    throw new NotImplementedException();
  }
}