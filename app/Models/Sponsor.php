<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    public function garages() {
        return $this->belongsToMany('App\Models\Garage');
    }
}
