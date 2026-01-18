<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectLocation extends Model
{
    protected $fillable = [
        'campaign_id',
        'project_name',
        'address',
        'city',
        'state',
        'country',
        'latitude',
        'longitude',
        'status'
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
