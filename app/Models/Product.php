<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'language_id',
        // 'category_id',
        'product_colour_id',
        'feature_image',
        'summary',
        // 'description',
        'key_info',
        'tips_advice',
        'documentation',
        'product_feature',
        'variations',
        'addons',
        'current_price',
        'previous_price',
        'rating',
        'status',
        'is_feature',
    ];

    public function category() {
        return $this->hasOne('App\Models\Pcategory','id','category_id');
    }

    public function product_reviews() {
        return $this->hasMany('App\Models\ProductReview');
    }

    public function product_images() {
        return $this->hasMany('App\Models\ProductImage');
    }

    public function language() {
        return $this->belongsTo('App\Models\Language');
    }

    public function cartItem() {
      return $this->hasOne('App\Models\CartItem');
    }

    // added by me
    public function subcategory() {
        return $this->belongsToMany('App\Models\Subcategory');
    }

    public function productColour(){
        return $this->belongsTo(ProductColour::class, 'product_colour_id');
    }

    public function getSummaryAttribute($value)
    {
        return explode ("+", $value);
    }

}
