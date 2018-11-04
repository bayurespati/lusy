<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopItem extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shop_items';

    /**
     * Settings
     */
    protected $guarded = [];

    protected $hidden = [
        'created_at', 'updated_at',
    ];


    public function images()
    {
        return $this->hasMany(ShopImage::class, 'shop_item_id');
    }

    public function inquiries()
    {
        return $this->hasMany(ShipInquiry::class, 'shop_item_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
