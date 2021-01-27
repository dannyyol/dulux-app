<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ColourCategory extends Model
{
    //

    protected $fillable = ['category_name','category_code','category_id','subcategory_id',
    'language_id','status','slug','image','is_feature',
    'colour_palette_id'];

    public function cpalettes() {
        return $this->belongsTo('App\Models\ColourPalette','colour_palette_id');
    }

    public function subFilter() {
        return $this->belongsTo('App\Models\Subcategory');
    }

    public function pcategory() {
        return $this->belongsTo('App\Models\Pcategory', 'category_id');
    }
    public function productColours(){
        return $this->hasMany(ProductColour::class, 'colour_category_id');
    }

    // public function subcategory() {
    //     return $this->belongsToMany('App\Models\Subcategory', 'colour_category_subcategory', 'colour_category_id',
    //     'subcategory_id');
    // }
}
