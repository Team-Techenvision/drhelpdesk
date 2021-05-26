<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class size extends Model
{
    //

    public function ProductAttribute()
    {
        return $this->hasMany('App\ProductAttribute');
    }
}
