<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Api\GoogleMapsApi;

class PedidoController extends Controller
{

	public function calcularLatLong(GoogleMapsApi $gmaps)
	{
		$lat1 = -22.969020;
        $lon1 = -20.466892;
        $lat2 = -42.026464;
        $lon2 = -54.611513;
	    $unit = 'K';

		$distancia = $gmaps->calculaDistancia($lat1, $lon1, $lat2, $lon2, $unit);

		return response()->json(['distancia' => $distancia]);
	}
}
