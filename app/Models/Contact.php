<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';
    protected $fillable = ['contact_email', 'display_email', 'heading_text', 'subtext', 'linkedin_url', 'github_url'];
}
