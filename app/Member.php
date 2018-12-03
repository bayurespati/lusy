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
    protected $guraded = ['is_active'];

    protected $hidden = [
    	'created_at', 'updated_at',
    ];


    /**
     * Relations
     */
    public function teacher()
    {
        return $this->belongsTo(self::class, 'teacher_id');
    }

    public function student()
    {
        return $this->hasMany(self::class, 'teacher_id')->with('rank','region','subscription','class');
    }

    public function class(){
        return $this->belongsToMany('App\AboutContent', 'member_class', 'member_id', 'class_id')
                    ->withPivot('is_approve');
    }

    public function classActive(){
        return $this->belongsToMany('App\AboutContent', 'member_class', 'member_id', 'class_id')
                    ->wherePivot('is_approve', 1);
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

    /**
    * Accessor
    */
    public function getIsActiveAttribute($value)
    {
        return (bool) $value;
    }

    public function getIsTeacherAttribute($value)
    {
        return (bool) $value;
    }
}