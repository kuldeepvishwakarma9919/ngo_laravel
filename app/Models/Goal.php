<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    protected $fillable = [
        'campaign_id',
        'title',
        'description',
        'target_amount',
        'achieved_amount',
        'start_date',
        'end_date',
        'status'
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function progressPercentage()
    {
        if ($this->target_amount == 0) return 0;
        return round(($this->achieved_amount / $this->target_amount) * 100);
    }
}
