<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationTransaction extends Model
{
    protected $fillable = [
        'donor_name',
        'donor_email',
        'donor_phone',
        'campaign_id',
        'amount',
        'payment_id',
        'payment_gateway',
        'payment_status',
        'receipt_no',
    ];
    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }
}
