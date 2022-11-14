<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Garage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
}
