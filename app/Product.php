<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    protected $primaryKey = 'products_id';
    protected $fillable=['product_name','slug','product_code','price','special_price','quantity','extra_discount','key_features','short_description','long_description','brand','prescription','categories','sub_categories','sub_sub_categories','sub_sub_sub_categories','featured_product','top_selling_product','vendor_id','tags','gst_id','rating','barcode','manufacturer'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    protected static function boot()
    {
        parent::boot();

        // static::addGlobalScope('inStock', function (Builder $builder) {
        //     $builder->where('in_stock', '!=', 0);
        // });
    }

    public function ProductAttribute()
    {
        return $this->hasMany('App\ProductAttribute');
    }
}
