<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Garage;
use Dotenv\Result\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Psy\Readline\Hoa\Console;

class GarageController extends Controller
{
    public function index()
    {
        $garages = Garage::with(['services'])->paginate(10);
        //dd($garages);

        foreach ($garages as $garage) {
            if ($garage->image) {
                $garage->image = asset('storage/' . $garage->image);
            } else {
                $garage->image = asset('img/no_image.jpg');
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

    public function searchForRadius($radius, $lat, $long, $n_parking, $services)
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

        $garage = Garage::whereBetween('latitude', [$minLat, $maxLat])->whereBetween('longitude', [$minLong, $maxLong])->with(['services'])
            ->when($n_parking, function ($query , $n_parking){
                return $query->where('n_parking','>=', $n_parking);
            })
            ->when($services, function ($query , $services){
                $servicesArr =  explode(',', $services);
                $filteredGaragesId = $this->garageIdByServices($servicesArr);
                return $query->whereIn('id', $filteredGaragesId);
            })->paginate(10);

        return response()->json([
        'success' => 'ok',
        'results' => $garage
        ]);
    }

    public function garageIdByServices($servicesArr)
    {
        $filteredGaragesId = [];
        foreach($servicesArr as $service){
            $garagesIdArr =[];
            $garagesId = Garage::whereHas('services', function($query) use ($service){
                $query->where('services.id', $service);
            })->get('garages.id');

            foreach($garagesId as $garageId){
                array_push($garagesIdArr ,$garageId->id);
            }

            if($filteredGaragesId){
                $result = array_intersect($filteredGaragesId, $garagesIdArr);
                $filteredGaragesId = $result;
            } else {
                $filteredGaragesId = $garagesIdArr;
            }
        }
        return $filteredGaragesId;
    }

    public function show($id)
    {
        $garage = Garage::where('slug', $id)->with(['services'])->firstOrFail();

        if ($garage->image) {
            $garage->image = asset('storage/' . $garage->image);
        } else {
            $garage->image = asset('img/no_image.jpg');
        }

        if ($garage) {
            return response()->json([
                'success' => true,
                'results' => $garage
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'not found'
            ]);
        }
    }
}
