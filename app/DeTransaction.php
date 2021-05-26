<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeTransaction extends Model
{
    protected $table = 'de_wallet_transactions';
    protected $fillable = [
        'id','from_user', 'to_user', 'source','coins','code','status'
    ];

    public function toUser()
    {
        return $this->belongsTo(User::class,'to_user');
    }
}
