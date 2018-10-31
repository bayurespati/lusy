<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopItem extends Model
{
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
