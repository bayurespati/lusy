<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    public function gallerries()
    {
        return $this->hasMany(Gallery::class, 'sub_category_id');
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'sub_category_id');
    }

    public function shops()
    {
        return $this->hasMany(ShopItem::class, 'sub_category_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
