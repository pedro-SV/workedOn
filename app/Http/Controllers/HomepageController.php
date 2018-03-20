<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    //
    public function index()
    {
        $tickets = Ticket::all();
        return view('homepage', compact('tickets'));
    }
}
