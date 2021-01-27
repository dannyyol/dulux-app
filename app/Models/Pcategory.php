<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pcategory extends Model
{
    // protected $table = 'filter_categories';

    protected $fillable = ['name','language_id','status','slug','image','is_feature'];

    // 
    public function products() {
        return $this->hasMany('App\Models\Product','category_id','id');
    }

    public function productColour() {
        return $this->hasMany('App\Models\ProductColour','category_id','id');
    }

    public function language() {
        return $this->belongsTo('App\Models\Language');
    }

    public function subcategory() {
        return $this->hasMany(Subcategory::class, 'category_id');
    }


     public function colourPalettes() {
        return $this->belongsToMany('App\Models\ColourPalette', 'pcategory_colour_palette', 'pcategory_id');
    }

    public function colourCategory() {
        return $this->hasMany('App\Models\ColourCategory', 'category_id');
    }

    


}
