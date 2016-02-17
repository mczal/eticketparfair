<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Type;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TypeController extends Controller
{
    /**
    * Types list view
    * @param Request
    */
    public function index(Request $request){
        $name = $request->name;

        if(!empty($name)){
            $types = Type::where('name', 'like', '%' . $name . '%')->paginate(10);
        }else{
            $types = Type::paginate(10);
        }


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
        $type = Type::where(['id' => $id])->first();
        return view('types.show', [
            'type' => $type,
        ]);
    }

    /**
    * Show data with form
    */
    public function edit($id){
        $type = Type::where(['id' => $id])->first();
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

        $type = Type::where(['id' => $id])->first();
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
        $type = Type::where(['id' => $id])->first();
        $type->delete();

        return redirect('/types')->with('success_message', 'Type <b>' . $type->name . '</b> was deleted.');
    }
}
