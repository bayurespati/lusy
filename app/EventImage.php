<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventImage extends Model
{

	/**
     * Settings
     */
    protected $guarded = [];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
    * Accessor
    */
    public function getIsPosterAttribute($value)
    {
        return (bool) $value;
    }
}
