<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicantList extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'applicant_list';

    /**
     * Settings
     */
    protected $guarded = [];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

}
