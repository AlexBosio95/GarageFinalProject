<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Garage extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }
}
