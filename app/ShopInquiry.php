<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopInquiry extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shop_inquiries';

    /**
     * Settings
     */
    protected $guarded = [];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function shop()
    {
        return $this->belongsTo(ShopItem::class, 'shop_item_id');
    }
}
