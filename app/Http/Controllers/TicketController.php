<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Ticket;
use App\Repositories\TicketRepositories;

class TicketController extends Controller
{
    //

    protected $tickets;

    public function __construct(TicketRepositories $tickets){
      $this->tickets = $tickets;
    }

    public function index(Request $request){
      $tickets = Ticket::all();

      return view('tickets/tickets', compact('tickets'));
    }

    public function single($id){
      $ticket = Ticket::find($id);

      return view('ticket', compact('ticket'));
    }


}
