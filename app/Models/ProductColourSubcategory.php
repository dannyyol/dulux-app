<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductColourSubcategory extends Model
{
    //
    protected $table ="product_colour_subcategory";



    public function productColour()
	{
	    return $this->belongsTo('App\Models\ProductColour', 'product_colour_id');
	}
	public function subcategory()
	{
	    return $this->belongsTo('App\Models\Subcategory','subcategry_id');
	}
}
