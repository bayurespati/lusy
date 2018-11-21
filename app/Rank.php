<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ranks';

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

    public function member(){
    	return $this->belongsToMany('App\Member', 'member_rank', 'rank_id', 'member_id')->withPivot('annointed_date');
    }

}
