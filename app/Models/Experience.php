<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $table = 'experiences';
    protected $fillable = ['position', 'company', 'logo', 'start_date', 'end_date', 'description', 'location', 'responsibilities', 'technologies', 'roles', 'display_type'];
    protected $casts = [
        'roles' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
    ];
}
