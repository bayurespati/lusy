<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageConfig extends Model
{
    
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'image_config';

    /**
     * Settings
     */
    protected $guraded = [];

    protected $hidden = [
    	'created_at', 'updated_at',
    ];
}
	