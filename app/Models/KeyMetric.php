<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeyMetric extends Model
{
    protected $fillable = ['value', 'label', 'order'];
}
