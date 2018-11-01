<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * Settings
     */
    protected $guarded = [];

    protected $hidden = [
        'created_at', 'updated_at',
    ];


    public function subcategories()
    {
        return $this->hasMany('App\SubCategory', 'category_id');
    }
}
