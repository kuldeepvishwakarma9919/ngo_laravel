<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AuditReport extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'financial_year',
        'report_type',
        'file_path',
        'file_size',
        'ca_name',
        'udid_number',
        'summary',
        'is_public',
        'download_count',
    ];
}
