<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComplianceDocument extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'doc_type',
        'doc_number',
        'issue_date',
        'expiry_date',
        'file_path',
        'authority',
        'status',
        'is_public',
        'remarks'
    ];
}
