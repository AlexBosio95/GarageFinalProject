<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('garages', 'Api\GarageController@index');
Route::get('garages/{address}', 'Api\GarageController@search');
Route::get('garages/{radius}/{lat}/{long}/{n_parking}/{services}', 'Api\GarageController@searchForRadius');

Route::get('services', 'Api\ServicesController@index');

Route::get('garage/{slug}', 'Api\GarageController@show');