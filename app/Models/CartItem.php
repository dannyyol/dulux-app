<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    //
    protected $fillable = [
        'id','product_id', 'product_name','feature_image', 'product_quantity', 'product_price','sub_total', 'user_token_id'
    ];


    public function product() {
      return $this->belongsTo('App\Models\Product');
    }

    // public function getAttribute($value)
    // {
    // $array = @unserialize($value); //Check if the value is serialize or not
    // if($array){
    // return unserialize($value);
    // }
    // }
}
