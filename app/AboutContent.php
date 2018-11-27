<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AboutContent extends Model
{
	protected $table = 'about_contents';

    protected $fillable = [
        'image_path',
        'title', 
        'content',
        'is_class',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];


    public function member(){
        return $this->belongsToMany('App\Member', 'member_rank', 'class_id', 'member_id')->withPivot('is_approve');
    }
}