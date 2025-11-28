<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'skills';
    protected $fillable = ['name', 'level', 'category_id', 'logo'];

    public function category()
    {
        return $this->belongsTo(SkillCategory::class, 'category_id');
    }
}
