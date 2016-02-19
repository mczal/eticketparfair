<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\ConfirmationRepositories;
use App\Confirmation;

class ConfirmationController extends Controller
{
    protected $confirmations;

    public function __construct(ConfirmationRepositories $confirmations){
        $this->confirmations = $confirmations;
    }

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $confirmations = Confirmation::paginate(30);

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
        return view('confirmations.create');
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
            'order_id' => 'required',
        ]);

        $confirmation = Confirmation::where(['id' => $id])->first();
        $confirmation->no_rekening = $request->no_rekening;
        $confirmation->nama_bank = $request->nama_bank;
        $confirmation->total_transfer = $request->total_transfer;
        $confirmation->order_id = $request->order_id;
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
}
