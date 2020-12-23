<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilterSubcategory extends Model
{
    //

    public function products() {
        return $this->belongsToMany('App\Models\Products');
    }

    public function categories() {
        return $this->hasOne('App\Models\category');
    }
}
