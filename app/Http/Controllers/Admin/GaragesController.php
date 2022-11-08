<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Garage;
use App\Models\Service;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use Illuminate\Support\Str;

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

        //dd($request);

        $request->validate([
            'title'=>'required|max:255|min:3',
            'sqmt'=> 'nullable|max:255',
            'length' => 'nullable|max:255',
            'width'=> 'nullable|max:255',
            'height'=> 'nullable|max:255', 
            'n_parking'=> 'required|max:255', //! needs fix (forse exist come con services) 
            'address'=> 'required|max:255|min:1',
            'services'=> 'exists:services,id',
            //'image'=> 'nullable|max:10000|image',
            'description'=> 'nullable|max:65535|min:1'
        ]);
        $data = $request->all();
        
        $newGarage = new Garage();

        $newGarage->fill($data);

        $newGarage->latitude = 1;

        $newGarage->longitude =2;

        $slug = $this->getSlug($newGarage->title);

        $newGarage->slug=$slug;

        //* Il Garage viene correttamente creato nel database, ma non visualizzato nella index, bisognerebbe anceh fare la sync tra lo user id e il garage così verrà visualizzato.
            

        $newGarage->save();

        if (array_key_exists('services', $data)){
            $newGarage->services()->sync($data['services']);
        }

        return redirect()->route('admin.garages.index');
    }
   


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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

}
