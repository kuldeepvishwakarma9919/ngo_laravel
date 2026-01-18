<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrowdfundingTeam extends Model
{
    protected $fillable = [
        'campaign_id',
        'team_name',
        'leader_id',
        'target_amount',
        'raised_amount',
        'status'
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }
}

