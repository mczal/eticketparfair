<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\ConfirmationRepositories;
use App\Repositories\OrderRepositories;
use App\Confirmation;

class ConfirmationController extends Controller
{
    protected $confirmations;
    protected $orders;

    public function __construct(ConfirmationRepositories $confirmations, OrderRepositories $orders){
        $this->middleware('auth');
        $this->confirmations = $confirmations;
        $this->orders = $orders;
        //dd($this->orders->getAllActive());
    }

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
        //$confirmation = Confirmation::where(['id' => 2])->first();

        //dd($confirmation->order->tickets);
        //dd($confirmation);
        //--
        $status = $request->status;
        $confirmations = $this->confirmations->getAllFiltered($status);
        //dd($confirmations);
        return view('confirmations.index',[
            'confirmations' => $confirmations,
        ]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('confirmations.create',[
          'orders' => $this->orders->getAllActive(),
        ]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        $this->validate($request,[
            'no_rekening' => 'required',
            'nama_bank' => 'required',
            'total_transfer' => 'required',
            'order_id' => 'required',
        ]);

        $confirmation = new Confirmation;
        $confirmation->order_id = $request->order_id;
        $confirmation->no_rekening = $request->no_rekening;
        $confirmation->nama_bank = $request->nama_bank;
        $confirmation->total_transfer = $request->total_transfer;
        $confirmation->save();

        /*Mail::send('emails.order', ['order' => $order], function($m) use ($order){
            $m->from('wilianto.indra@gmail.com', 'Parahyangan Fair');
            $m->to($order->email, $order->name);
            $m->subject('Thank you for order');
        });*/

        return redirect('/confirmations')->with('success_message', 'confirmation was created');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $confirmation = Confirmation::where(['id' => $id])->first();
        return view('confirmations.show',[
            'confirmation' => $confirmation,
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
        $confirmation = Confirmation::where(['id' => $id])->first();
        return view('confirmations.edit',[
            'confirmation' => $confirmation,
        ]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id,Request $request)
	{
        $this->validate($request,[
            'no_rekening' => 'required',
            'nama_bank' => 'required',
            'total_transfer' => 'required',
        ]);

        $confirmation = Confirmation::where(['id' => $id])->first();
        $confirmation->no_rekening = $request->no_rekening;
        $confirmation->nama_bank = $request->nama_bank;
        $confirmation->total_transfer = $request->total_transfer;
        $confirmation->save();

        return redirect('/confirmations')->with('success_message', 'Confirmation id:<b>' . $confirmation->id . '</b> was saved.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $confirmation = Confirmation::where(['id' => $id])->first();
        $confirmation->delete();

        return redirect('/confirmations')->with('success_message', 'Confirmation id:<b>' . $confirmation->id . '</b> was deleted.');
	}

  /**
	 * Validate Order (set )
	 *
	 * @param  int  $id
	 * @return Response
	 */
   public function validateOrder(Request $request){
     $confirmation = Confirmation::where(['id' => $request->id])->first();
     $order = $confirmation->order;
     $order->status = \App\Order::STATUS_PAID;
     $order->save();
     //dd($order);
     foreach($confirmation->order->tickets as $ticket){
       $ticket->active_date = date('Y-m-d H:i:s');
       $ticket->save();
     }
     $confirmation->status = Confirmation::STATUS_PAID;
     $confirmation->save();
     return redirect('/confirmations')->with('success_message', 'Confirmation id:<b>' . $confirmation->id . '</b> was deleted.');

   }

}
