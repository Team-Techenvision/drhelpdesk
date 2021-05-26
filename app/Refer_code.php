<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refer_code extends Model
{
    protected $table = 'refer_code';
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
