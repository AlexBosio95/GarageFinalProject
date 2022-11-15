<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Garage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Psy\Readline\Hoa\Console;

class GarageController extends Controller
{
    public function index()
    {
        $garages = Garage::with(['services'])->paginate(10);

        foreach ($garages as $garage) {
            if ($garage->cover) {
                $garage->cover = asset('storage/' . $garage->cover);
            } else {
                $garage->cover = asset('img/no_image.jpg');
            }
        }

        return response()->json([
            'success' => true,
            'results' => $garages
        ]);
    }

    public function search($address)
    {

        $garage = Garage::where('address', 'like', '%' . $address . '%')->get();

        return response()->json([

            'success' => 'ok',
            'results' => $garage

        ]);

    }

    public function searchForRadius($radius, $lat, $long)
    {
        $latVar = 0;
        $longVar = 0;

        switch ($radius) {
            case '20000':
                $latVar = 0.1799;
                $longVar = 0.2353;

                break;

            case '50000':
                $latVar = 0.44975;
                $longVar = 0.58823;
                
                break;
            
            default:
                $latVar = 0.1799;
                $longVar = 0.2353;

                break;
        }

        $minLat = $lat - $latVar;
        $maxLat = $lat + $latVar;

        $minLong = $long - $longVar;
        $maxLong = $long + $longVar;

        dd($minLat, $maxLat);


        $garage = Garage::whereBetween('latitude', [$minLat, $maxLat])->whereBetween('longitude', [$minLong, $maxLong])->get();

        return response()->json([

            'success' => 'ok',
            'results' => $garage

        ]);

    }
}
