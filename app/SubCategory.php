<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sub_categories';

    /**
     * Settings
     */
    protected $guarded = [];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    /**
     * Relationships
     */
    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function galleries()
    {
        return $this->hasMany('App\Gallery', 'sub_category_id');
    }
}
