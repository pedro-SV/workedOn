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
        
        $walker->push(
            'project = '. $project . ' AND status = "'. $status . '"'
        );

        $newTickets = 0;
        $updatedTickets = 0;

        foreach ($walker as $issue) {

            /** @var Issue $issue */

            $isNotImported = is_null(
                Ticket::where('external_id', $issue->getKey())
                    ->first());

            if ($isNotImported) {
                $newTickets++;
            }
            else {
                $updatedTickets++;
            }

            $external_created = new Carbon($issue->getCreated());

            $external_updated = new Carbon($issue->getUpdated());

            Ticket::updateOrCreate(
                ['external_id' => $issue->getKey()],
                [
                    'title' => $issue->getSummary(),
                    'external_created' => $external_created,
                    'external_updated' => $external_updated,
                    'external_status' => $issue->getStatus()['name'],
                ]
            );
        }
        
        return redirect()->route('homepage')->with('message', 'You have imported ' . $newTickets . ' new tickets and updated ' . $updatedTickets . ' tickets.');
    }
}
