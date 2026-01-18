<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'campaign_id', 
        'title',
        'category',
        'amount',
        'expense_date',
        'payment_mode',
        'reference_no',
        'paid_to',
        'bill_path',
        'remarks',
        'status',
    ];
}
