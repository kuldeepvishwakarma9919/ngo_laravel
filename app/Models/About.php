<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $table = 'abouts';
    protected $fillable = [
        'id',
        'title', 
        'short_description', 
        'description', 
        'vision', 
        'mission', 
        'history', 
        'years_of_experience', 
        'total_volunteers', 
        'total_beneficiaries', 
        'banner_image', 
        'about_image', 
        'meta_title', 
        'meta_description', 
        'status'
    ];
}