<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Blog extends Model
{
    protected $fillable = [
        'category_id','title','slug','author_name',
        'short_description','content',
        'featured_image','video_url',
        'status','is_featured',
        'meta_title','meta_description','meta_keywords',
        'published_at'
    ];

    public function blog_categories()
    {
        return $this->belongsTo(BlogCategory::class,'category_id');
    }
}

