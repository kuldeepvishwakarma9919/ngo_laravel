<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'target_amount',
        'raised_amount',
        'start_date',
        'end_date',
        'status'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
    ];


    public function teams()
    {
        return $this->hasMany(CrowdfundingTeam::class);
    }

    public function transactions()
    {
        return $this->hasMany(DonationTransaction::class, 'campaign_id');
    }

    public function getProgressAttribute()
    {
        if ($this->target_amount <= 0) return 0;
        $percent = ($this->raised_amount / $this->target_amount) * 100;
        return $percent > 100 ? 100 : round($percent, 2);
    }
}
