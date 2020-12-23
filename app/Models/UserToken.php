<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserToken extends Model
{
    //
    protected $fillable = [
        'token', 'cart_item_id'
    ];

    public function cartItem()
    {
        return $this->hasMany(cartItem::class, 'user_token_id');
    }
}
