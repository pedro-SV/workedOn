<?php

namespace App\Http\Controllers;

use App\Ticket;
use Carbon\Carbon;
use chobie\Jira\Api;
use chobie\Jira\Issue;
use chobie\Jira\Issues\Walker;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    //

    public function importForm(Api $api)
    {
        $result = $api->getProjects()->getResult();

        $projects = [];

        foreach ($result as $item) {
            $projects[$item['key']] = $item['name'];
        }

        $result = $api->getStatuses();

        foreach ($result as $item) {
            $status[$item['name']] = $item['name'];
        }

        return view('importForm', compact(['projects', 'status']));
    }

    public function importRun(Walker $walker, Request $request)
    {

        $project = $request->get('project');
        $status = $request->get('status');

        // @TODO Import tickets dynamically
        // - make project configurable
        // - make status configurable
        $walker->push(
            'project = '. $project . ' AND status = "'. $status . '"'
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

            $external_created = new Carbon($issue->getCreated());

            Ticket::updateOrCreate(
                ['external_id' => $issue->getKey()],
                [
                    'title' => $issue->getSummary(),
                    'external_created' => $external_created,
                ]
            );
        }
    }
}
