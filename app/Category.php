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

    /**
     * Relationships
     */
    public function subcategories()
    {
        return $this->hasMany(SubCategory::class, 'category_id');
    }

    public function shopItems(){
        return $this->hasMany(ShopItem::class, 'category_id');
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'category_id');
    }

}
