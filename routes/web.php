<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Auth::routes();

Route::middleware('auth')
        ->namespace('Admin')
        ->name('admin.')
        ->prefix('admin')
        ->group(function () {
            Route::get('/', 'HomeController@index')->name('home');
            Route::resource('garages', 'GaragesController');
            
            Route::delete('garages/destroy/{garage}', 'GaragesController@deleteCover')->name('garages.deleteCover');

            Route::get('messages/{garage}', 'GaragesController@showMsg')->name('messages');
            
            Route::get('views/{garage}', 'GaragesController@showViews')->name('views');
        });

Route::get('{any?}', function() {
    return view('guest.home');
})->where('any', '.*');

