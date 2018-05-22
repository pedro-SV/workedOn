<?php

namespace Tests\Unit;

use App\Ticket;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TicketTest extends TestCase
{

    use \Illuminate\Foundation\Testing\DatabaseMigrations;

    public function testAllStatuses()
    {
        $ticket = new Ticket();
        $ticket->external_id = 'POR-23';
        $ticket->title = 'New ticket';
        $ticket->external_status = 'In progress';
        $ticket->save();

        $ticket = new Ticket();
        $ticket->external_id = 'BRA-23';
        $ticket->title = 'New ticket 2';
        $ticket->external_status = 'To Do';
        $ticket->save();

        $statuses = Ticket::allStatuses();

        $this->assertEquals(['In progress', 'To Do'], $statuses, $delta = 0.0, $canonicalize = true);

    }
}
