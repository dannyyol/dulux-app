<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductColour extends Model
{
    //

    protected $fillable = ['colour_name','colour_code','colour_category_id', 'language_id','status', 'colour_stages','slug','image','is_feature', 'category_id'];
    public function colourCategory(){
        return $this->belongsTo(ColourCategory::class, 'colour_category_id');
    }


    public function products(){
        return $this->hasMany(Product::class, 'product_colour_id');
    }

    public function subcategory() {
        return $this->belongsToMany('App\Models\Subcategory', 'product_colour_subcategory', 'product_colour_id',
        'subcategory_id');
    }

    public function pcategory(){
    return $this->belongsTo(Pcategory::class, 'category_id');
    }



    public function productColourSubcategory()
    {
        return $this->hasMany('App\Models\ProductColourSubcategory');
    }
}
