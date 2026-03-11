<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterInfo extends Model
{
    protected $fillable = ['email', 'address', 'privacy_policy_link', 'newsletter_link'];
}
