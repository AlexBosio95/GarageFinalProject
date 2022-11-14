<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Garage;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
Use Illuminate\Support\Str;
Use Illuminate\Support\Facades\Storage;

class GaragesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $garages = Garage::where('user_id', $user_id)->get();
        return view('admin.garages.index', compact('garages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services= Service::all();

        return view('admin.garages.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title'=>'required|max:255|min:3',
            'length' => 'nullable|max:255|numeric',
            'width'=> 'nullable|max:255|numeric',
            'height'=> 'nullable|max:255|numeric',
            'n_parking'=> 'required|numeric|between:1,5',
            'address'=> 'required|max:255|min:1',
            'services'=> 'exists:services,id',
            'image'=> 'nullable|max:10000|image',
            'description'=> 'nullable|max:65535|min:1'
        ]);
        $data = $request->all();

        $newGarage = new Garage();

        if (array_key_exists('image', $data)){

            $image = Storage::put('uploads', $data[ 'image']);
            $data['image'] = $image;
        }

        $newGarage->fill($data);

        $newGarage->sqmt = $data['length'] * $data['width'];

        //chiamata all'endpoint
        $tom_tom = Http::get('https://api.tomtom.com/search/2/geocode/' . str_replace('/ /gi', "-", $data['address']) . '.json?key=' . '4Hp3L2fnTAkWmOm1ZdH2caelj0iHxlMM&countrySet=IT');

        $results = json_decode($tom_tom);

        //recupero delle coordinate
        $coordinates = $results->results[0]->position;

        //assegnazione delle coordinate
        $newGarage->latitude = $coordinates->lat;
        $newGarage->longitude = $coordinates->lon;

        $slug = $this->getSlug($newGarage->title);

        $newGarage->slug=$slug;

        $newGarage->user_id = Auth::id();
        //dd($newGarage);
        $newGarage->save();

        if (array_key_exists('services', $data)){
            $newGarage->services()->sync($data['services']);
        }
        
        return redirect()->route('admin.garages.index')->with('created', 'Created succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Garage $garage)
    {
        $user_id = Auth::id();

       //dd($garage[0]);

        if ($garage != null) {
            if($garage->user_id != $user_id) {
                abort(403);
            }
            return view('admin.garages.show', compact('garage'));

        } else {

            abort(404);
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Garage $garage)
    {
        $services= Service::all();

        $user_id = Auth::id();

        if ($garage != null) {

            if($garage->user_id != $user_id) {
                abort(403);
            }

            return view('admin.garages.edit', compact('services', 'garage'));

        } else {

            abort(404);
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Garage $garage)
    {
        $request->validate([
            'title'=>'required|max:255|min:3',
            'length' => 'nullable|max:255|numeric',
            'width'=> 'nullable|max:255|numeric',
            'height'=> 'nullable|max:255|numeric',
            'n_parking'=> 'required|numeric|between:1,5',
            'address'=> 'required|max:255|min:1',
            'services'=> 'exists:services,id',
            'image'=> 'nullable|max:10000|image',
            'description'=> 'nullable|max:65535|min:1',
            'available'=>'boolean'
        ]);


        $data = $request->all();


        if (!array_key_exists('available', $data)) {
            $garage->available = false;
        }



        if ($data['title'] !== $garage->title) {
            $slug = $this->getSlug($garage->title);
            $garage->slug=$slug;
        }

        if (array_key_exists('image', $data)){

            if ($garage->image){
                Storage::delete($garage->image);
            }
            $image = Storage::put('uploads', $data[ 'image']);
            $data['image'] = $image;
        }

        $garage->sqmt = $data['length'] * $data['width'];

        //chiamata all'endpoint
        $tom_tom = Http::get('https://api.tomtom.com/search/2/geocode/' . str_replace('/ /gi', "-", $data['address']) . '.json?key=' . '4Hp3L2fnTAkWmOm1ZdH2caelj0iHxlMM&countrySet=IT');

        $results = json_decode($tom_tom);

        //recupero delle coordinate
        $coordinates = $results->results[0]->position;

        //assegnazione delle coordinate
        $garage->latitude = $coordinates->lat;
        $garage->longitude = $coordinates->lon;


        $garage->update($data);

        if (array_key_exists('services', $data)){
            $garage->services()->sync($data['services']);
        } else {
            $garage->services()->sync([]);
        }

        return redirect()->route('admin.garages.index')->with('edited', 'edited succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $garage= Garage::find($slug);

        $garage->services()->sync([]);

        if ($garage->image){
            Storage::delete($garage->image);
        }

        $garage->delete();

        return redirect()->route('admin.garages.index')->with('deleted', 'deleted succesfully');


    }

    protected function getSlug($title)
    {
        //*Crea uno slug univoco per ogni titolo/
        $slug = Str::slug($title, '-');
        $checkSlug = Garage::where('slug', $slug)->first();
        $counter = 1;

        while($checkSlug) {
            $slug = Str::slug($title . '-' . $counter, '-');
            $counter++;
            $checkSlug = Garage::where('slug', $slug)->first();
        }

        return $slug;
    }

    public function deleteCover(Garage $garage) {

        if ($garage->image) {
            Storage::delete($garage->image);
        }

        $garage->image = '';
        $garage->save();

        return redirect()->route('admin.garages.edit', [ 'garage' => $garage->slug])->with('img-removed', 'Immagine cancellata con successo');

    }

}
