<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PDF;
use App\Type;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\TypeRepositories;

class TypeController extends Controller
{
    protected $types;

    /**
     * Create a new controller instance.
     *
     * @param  TypeRepositories  $tasks
     * @return void
     */
     public function __construct(TypeRepositories $types){
         $this->middleware('auth');
         $this->types = $types;
     }

    /**
    * Types list view
    * @param Request
    */
    public function index(Request $request){
        $name = $request->name;

        $types = $this->types->getAllFiltered($name);

        return view('types.index', [
            'types' => $types,
            'name' => $name,
        ]);
    }

    /**
    * Show create form
    */
    public function create(){
        return view('types.create');
    }

    /**
    * Process create form
    */
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
        ]);

        $type = new Type;
        $type->name = $request->name;
        $type->price = $request->price;
        $type->active = $request->active;
        $type->save();

        return redirect('/types')->with('success_message', 'Type <b>' . $type->name . '</b> was created.');
    }

    /**
    * Show data id
    */
    public function show($id){
        $type = $this->types->findById($id);
        return view('types.show', [
            'type' => $type,
        ]);
    }

    /**
    * Show data with form
    */
    public function edit($id){
        $type = $this->types->findById($id);
        return view('types.edit', [
            'type' => $type,
        ]);
    }

    /**
    * Process update form
    */
    public function update(Request $request, $id){
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
        ]);

        $type = $this->types->findById($id);
        $type->name = $request->name;
        $type->price = $request->price;
        $type->active = $request->active;
        $type->save();

        return redirect('/types')->with('success_message', 'Type <b>' . $type->name . '</b> was saved.');
    }

    /**
    * Delete the selected data
    */
    public function destroy($id){
        $type = $this->types->findById($id);
        $type->delete();

        return redirect('/types')->with('success_message', 'Type <b>' . $type->name . '</b> was deleted.');
    }

    public function printTicket($id){
        $type = $this->types->findById($id);
        is_dir('download/' . $type->id) ? '' : mkdir('download/' . $type->id, 0777, false);
        $tickets = $type->tickets;
        foreach($tickets as $ticket){
            $ticket->generatePDF(true)->save('download/' . $type->id . '/' . $ticket->unique_code . '.pdf');
        }
        return "PDF saved.";
    }
}
