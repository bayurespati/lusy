<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassRegion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'class_region';

    /**
     * Settings
     */
    protected $guarded = [];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
    

    /**
     * Relations
     */
    public function member(){
        return $this->belongsToMany('App\Member', 'member_region', 'region_id', 'member_id');
    }

}
