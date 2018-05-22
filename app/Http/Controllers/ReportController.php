<?php

namespace App\Http\Controllers;

use App\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function reportForm()
    {
        $statuses = Ticket::allStatuses();

        return view('reportForm', compact(['statuses']));
    }

    public function reportRun(Request $request)
    {
        $status = $request->get('status');

        $query = DB::table('tickets')->where('external_status', '=', $status);

        if ($tickets_from = $request->get('tickets_from')) {
            $query->whereDate('external_updated', '>=', new Carbon($tickets_from));
        }

        if ($tickets_to = $request->get('tickets_to')) {
            $query->whereDate('external_updated', '<=', new Carbon($tickets_to));
        }

        $tickets = $query->get();

        return view('reportRun', compact(['tickets']));
    }
}
