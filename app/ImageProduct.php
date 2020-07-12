<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageProduct extends Model
{
    protected $table = "image_product";

    protected $fillable = [
        'name',
        'product_id',
        'order_display',
        'created_at'
    ];

    public function product()
    {
        return $this->belongsTo("App\Product", "product_id", "id");
    }
}
