<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    public function garage() {
        return $this->belongsTo('App\Garage');
    }
}
