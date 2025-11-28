<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'name',
        'issuing_organization',
        'issue_date',
        'icon',
        'view_type',
        'credential_url',
        'certificate_image',
    ];

    protected $casts = [
        'issue_date' => 'date',
    ];
}
