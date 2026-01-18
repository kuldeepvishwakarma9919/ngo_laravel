<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'gender',
        'age',
        'category',
        'support_type',
        'address',
        'identity_no',
        'status',
        'registered_date'
    ];
}

