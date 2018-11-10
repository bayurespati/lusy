<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    /**
     * Settings
     */
    protected $table = 'contact_message';

    protected $guarded = [];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
