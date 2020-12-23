<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilterCategory extends Model
{
    //

    public function subcategories() {
        return $this->hasMany('App\Models\Subcategory');
    }
}
