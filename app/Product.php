<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "product";

    protected $fillable = [
        'cate_id',
        'brand_id',
        'name',
        'image_product',
        'slug_name',
        'meta_name',
        'description',
        'detail',
        'unit_price',
        'promotion_price',
        'new',
        'created_at',
    ];

    public function category()
    {
    	return $this->belongsTo('App\Category','cate_id','id');
    }
    public function product_properties()
    {
    	return $this->hasMany("App\ProductProperties","product_id","id");
    }
    public function product_image()
    {
    	return $this->hasMany("App\ImageProduct","product_id","id");
    }
    public function toSearchableArray()
    {
       return [
            'name'   => $this->name,
            'meta_name' => $this->meta_name
        ];
    }
}
