<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberPayment extends Model
{
     protected $fillable = [
        'member_id',        // ✅ ADD THIS
        'payment_type',
        'amount',
        'payment_method',
        'payment_status',
        'transaction_id',
        // 'payment_id',
        // 'order_id',
        'payment_date',
        
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
