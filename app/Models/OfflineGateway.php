<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfflineGateway extends Model
{
    protected $fillable = ['id', 'name', 'short_description', 'instructions', 'serial_number', 'status', 'is_receipt', 'receipt'];

    public static function messages($id = '') {
        return [
            'fname.required' => 'The first name field is required.',
            'lname.required' => 'The last name field is required.',
            'someone_fname.required' =>'The first name field is required.',
            'someone_lname.required' =>'The last name field is required.',
            'someone_number.required' =>'The number field is required.',
        ];
    }
}
