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
        return $this->belongsToMany('App\AboutContent', 'member_class', 'member_id', 'class_id')
                    ->withPivot('is_approve');
    }

    public function rank(){
        return $this->belongsToMany('App\Rank', 'member_rank', 'member_id', 'rank_id')->withPivot('annointed_date');
    }

    public function region(){
        return $this->belongsToMany('App\Region', 'member_region', 'member_id', 'region_id');
    }

    public function subscription(){
        return $this->hasMany('App\Subscription', 'member_id');
    }
}