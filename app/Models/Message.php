<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'email',
        'name',
        'surname',
        'text',
        'garage_id'
    ];

    public function garage() {
        return $this->belongsTo('App\Garage');
    }
}
