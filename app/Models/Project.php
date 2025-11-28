<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    protected $fillable = ['title', 'slug', 'content', 'image', 'published_at', 'description', 'technologies', 'category', 'github_url', 'live_url'];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function getCategoryLabelAttribute()
    {
        return match($this->category) {
            'ai' => 'AI/ML',
            'data' => 'Data Analysis',
            'game' => 'Game Development',
            'web' => 'Web Development',
            default => 'Web Development'
        };
    }
}
