<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventImage extends Model
{
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
