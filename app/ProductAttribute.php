<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    //
    protected $table = 'product_attributes';
    protected $fillable=['products_id','product_size','per_stript_qty','price_per_pic','product_color','in_stock','status','incremental_gst','multiple_attribute','barcode','manufacturer_price','price','special_price','quantity','extra_discount'];
    public function Product()
    {
        
        return $this->belongsTo('App\Product');
    }

    public function size()
    {
        
        return $this->belongsTo('App\size');
    }
}
