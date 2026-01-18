<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DCardVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id', 'verification_code', 'verified_at'
    ];
    public function member() {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
