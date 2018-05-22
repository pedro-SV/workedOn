<?php

namespace App\Http\Controllers;

use App\Providers\JiraServiceProvider;
use App\Ticket;
use Illuminate\Http\Request;
use chobie\Jira\Api;
use chobie\Jira\Api\Authentication\Basic;
use chobie\Jira\Issues\Walker;
use Illuminate\Support\Debug\Dumper;

class HomepageController extends Controller
{
    //
    public function index()
    {
        $tickets = Ticket::all()
            ->sortByDesc('external_created');
        
        return view('homepage', compact('tickets'));
    }

    public function test(Walker $walker)
    {

        $walker->push(
            'project = WOR AND status = "To Do"'
        );

        foreach ($walker as $issue) {
            (new Dumper())->dump($issue);
        }
    }
}
