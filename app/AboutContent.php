<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AboutContent extends Model
{
    protected $fillable = [
        'image_path',
        'title', 
        'content',
        'is_class',
    ];
}
