<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    protected $fillable = ['title', 'slug', 'content', 'image', 'published_at', 'description', 'technologies', 'category_id', 'github_url', 'live_url'];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(ProjectCategory::class, 'category_id');
    }

    public function getCategoryLabelAttribute()
    {
        return $this->category->name ?? 'Uncategorized';
    }

    public function getCategorySlugAttribute()
    {
        return $this->category->slug ?? 'uncategorized';
    }
}
