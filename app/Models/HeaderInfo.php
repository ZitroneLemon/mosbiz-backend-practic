<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeaderInfo extends Model
{
    protected $fillable = ['phone', 'email', 'feedback_link'];
}
