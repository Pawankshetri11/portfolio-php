<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectCategory extends Model
{
    protected $table = 'project_categories';
    protected $fillable = ['name', 'slug', 'description', 'color'];

    public function projects()
    {
        return $this->hasMany(Project::class, 'category_id');
    }
}
