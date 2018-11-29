<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'timelines';

    /**
     * Settings
     */
    protected $guarded = [];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
