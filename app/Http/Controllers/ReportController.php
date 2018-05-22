<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function reportForm()
    {
        //$statuses = Ticket::all(['external_status'])->unique();
        
        $statuses = Ticket::allStatuses();

        return view('reportForm', compact(['statuses']));
    }
}
