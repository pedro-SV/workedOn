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

    public static function allStatuses()
    {
        $unique_statuses = self::select('external_status')->distinct()->get();

        $statuses = [];

        foreach ($unique_statuses as $unique_status) {
            $statuses[] = $unique_status->external_status;
        }

        return $statuses;
    }
}
