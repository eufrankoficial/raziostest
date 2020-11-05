<?php

namespace App\Api;

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class GoogleMapsApi
{

	function calculaDistancia($lat1, $long1, $lat2, $long2, $unit = 'K')
	{
		$distance = sin(deg2rad($lat1))
                * sin(deg2rad($lat2))
                + cos(deg2rad($lat1))
                * cos(deg2rad($lat2))
                * cos(deg2rad($long1 - $long2));

	  	$distance = (rad2deg(acos($distance))) * 69.09;

		return $distance;
	}

}