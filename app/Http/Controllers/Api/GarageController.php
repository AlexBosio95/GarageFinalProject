<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Garage;
use Illuminate\Http\Request;

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
}
