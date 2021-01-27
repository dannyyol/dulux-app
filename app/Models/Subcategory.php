<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    //
    protected $table = 'subcategories';
    protected $fillable = ['name','language_id','status','slug','image','is_feature', 'category_id'];

    // added by
    public function products() {
        return $this->belongsToMany('App\Models\Product');
    }

    public function productColour($sub) {
    return
    $this->belongsToMany('App\Models\ProductColour')->wherePivot('subcategory_id', $sub);
    }

    public function colourCategories() {
        return $this->hasMany('App\Models\ColourCategory');
    }


    public function pcategories() {
        return $this->hasOne('App\Models\Pcategory','id','category_id');
    }


    public function productColourSubcategory()
	{
	    return $this->hasMany('App\Models\ProductColourSubcategory');
	}
    
}
