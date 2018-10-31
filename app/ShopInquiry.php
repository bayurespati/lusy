<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopInquiry extends Model
{
    public function shop()
    {
        return $this->belongsTo(ShopItem::class);
    }
}
