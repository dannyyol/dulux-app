<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ColourPalette extends Model
{
    //
    protected $fillable = ['palette_name','palette_code','language_id','status','slug','image','is_feature'];


    public function colourCategories() {
        return $this->hasMany('App\Models\ColourCategory','colour_palette_id');
    }

    public function pcategories() {
        return $this->belongsToMany('App\Models\Pcategory', 'pcategory_colour_palette', 'colour_palette_id');
    }

    

}
