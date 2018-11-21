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

    public function rank(){
        return $this->belongsToMany('App\Rank', 'member_rank', 'member_id', 'rank_id')->withPivot('annointed_date');
    }

    public function classRegion(){
        return $this->hasMany('App\ClassRegion', 'member_id');
    }

    public function subscription(){
        return $this->hasMany('App\Subscription', 'member_id');
    }
}