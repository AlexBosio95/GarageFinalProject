<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Garage extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function messages() {
        return $this->hasMany('App\Models\Message');
    }

    public function views() {
        return $this->hasMany('App\Models\View');
    }

    public function sponsors() {
        return $this->belongsToMany('App\Models\Sponsor');
    }

    public function services() {
        return $this->belongsToMany('App\Models\Service');
    }
}
