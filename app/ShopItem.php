<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopItem extends Model
{
    public function images()
    {
        return $this->hasMany(ShopImage::class, 'shop_item_id');
    }

     public function poster(){
        return $this->hasMany(ShopImage::class, 'shop_item_id')->whereIsPoster(true);
    }

    public function inquiries()
    {
        return $this->hasMany(ShipInquiry::class, 'shop_item_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }
}
