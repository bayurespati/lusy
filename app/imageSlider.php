<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageSlider extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'image_slider';

    /**
     * Settings
     */
    protected $guarded = [];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
