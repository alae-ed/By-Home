<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getCities($country_id)
    {
        $cities = City::where('country_id', $country_id)->get();
        return response()->json($cities);
    }
}

