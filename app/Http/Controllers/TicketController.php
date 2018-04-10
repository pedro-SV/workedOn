<?php

namespace App\Http\Controllers;

use App\Ticket;
use chobie\Jira\Issue;
use chobie\Jira\Issues\Walker;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    //
    public function import(Walker $walker)
    {
        // @TODO Import tickets dynamically
        // - make project configurable
        // - make status configurable
        $walker->push(
            'project = WOR AND status = "To Do"'
        );

        foreach ($walker as $issue) {

            /** @var Issue $issue */

            //$isNotImported = is_null(
            //    Ticket::where('external_id', $issue->getKey())
            //        ->first());
            //
            //if ($isNotImported) {
            //    $ticket = new Ticket();
            //    $ticket->external_id = $issue->getKey();
            //    $ticket->title = $issue->getSummary();
            //    $ticket->save();
            //}

            Ticket::updateOrCreate(
                ['external_id' => $issue->getKey()],
                ['title' => $issue->getSummary()]
            );
        }
    }
}
