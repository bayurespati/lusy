<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

	/**
     * Settings
     */
    protected $guarded = [];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    
	public function images()
    {
        return $this->hasMany(EventImage::class, 'event_id');
    }

    public function poster(){
        return $this->hasMany(EventImage::class, 'event_id')->whereIsPoster(true);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function applicants() {
        return $this->hasMany(ApplicantList::class, 'event_id');
    }
}
