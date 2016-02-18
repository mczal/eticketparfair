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

    public function index()
	{
		//
    $tickets = Ticket::all();

    return view('tickets.index', compact('tickets'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
    return view('tickets.create');
	}

  /**
  *My Function GENERATOR UNIQUE
  *
  */
   private function generateCode(){
    $code = "qwepoijhg23asdmnbzxABSNHQYIWPOMNZBVCkjhsad098712346";
    $result = "";
      for($i=0;$i<10;$i++){
        $result.=$code[rand(0,50)];
        echo $result."<br/>";
      }
     return $result;
   }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//
    $ticketType = $request->type;
    $amount = $request->amount;

    $this->validate($request, [
        'type' => 'required',
        'amount' => 'required',
    ]);

    for($i=0;$i<$amount;$i++){
      $ticket = new Ticket;
      $ticket->unique_code = $this->generateCode();
      $ticket->type_id = $ticketType;
      $ticket->order_id = 'null';
      $ticket->save();
    }

    return redirect('/tickets');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
    $ticket = Ticket::find($id);
    return view('tickets.show',[
      'ticket' => $ticket
    ]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
