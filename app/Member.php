<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'members';

    /**
     * Settings
     */
    protected $guraded = [];

    protected $hidden = [
    	'created_at', 'updated_at',
    ];


    /**
     * Relations
     */

    public function class(){
        return $this->belongsTo('App\AboutContent', 'class_id');
    }
}