<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'user_id',
        'father_name',
        'dob',
        'gender',
        'address',
        'city',
        'state',
        'pincode',
        'blade_group',
        'aadhaar_no',
        'photo',
        'occupation',
        'qualification',
        'id_card_no',
        'joined_date',
        'status',
        'select_id',
        'front', 
        'back'
    ];

   public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
