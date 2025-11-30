<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    protected $table = 'heros';
    protected $fillable = [
        'greeting',
        'first_name',
        'last_name',
        'title',
        'subtitle',
        'description',
        'image',
        'resume',
        'github_url',
        'linkedin_url',
        'email',
        'animation_label_1',
        'animation_label_2',
        'animation_label_3',
        'animation_label_4'
    ];
}
