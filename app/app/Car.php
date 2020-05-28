<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['number','driver_name'];

    public function autoparks()
    {
       return $this->belongsToMany(Autopark::class);
    }
}
