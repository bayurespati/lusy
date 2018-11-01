<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'galleries';

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
    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory', 'sub_category_id');
    }
}
