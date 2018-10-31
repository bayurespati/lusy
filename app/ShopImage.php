<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopImage extends Model
{
    public function shop()
    {
        return $this->belongsTo(ShopItem::class);
    }
}
