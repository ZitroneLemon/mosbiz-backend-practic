<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubordinateStructure extends Model
{
    protected $fillable = ['title', 'description', 'photo', 'link', 'link_text', 'order', 'is_active'];
}
