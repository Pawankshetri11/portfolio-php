<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';
    protected $fillable = [
        'id',
        'degree',
        'institution',
        'start_date',
        'end_date',
        'is_present',
        'location',
        'icon_style',
        'description'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_present' => 'boolean',
    ];
}
