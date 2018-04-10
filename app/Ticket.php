<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $guarded = [];

    protected $casts = [
        'external_created' => 'datetime',
    ];

    //
    public function description()
    {
        return $this->hasOne('App\TicketDescription');
    }
}
