<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxCertificate extends Model
{
    protected $fillable = [
        'donation_id',
        'certificate_no',
        'issued_date',
        'financial_year',
        'certificate_path'
    ];
    protected $casts = [
        'issued_date' => 'date',  
    ];
    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }
}
