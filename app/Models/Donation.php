<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $table = 'donations';

    protected $fillable = [
        'user_id',
        'added_by',
        'amount',
        'payment_mode',
        'transaction_id',
        'status',
        'donation_date',
    ];
}
