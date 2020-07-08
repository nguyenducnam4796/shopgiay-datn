<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "category";

    public function products()
    {
    	return $this->hasMany("App\Product","cate_id","id");
    }

    public function childrens()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')
            ->with('childrens');
    }
}
