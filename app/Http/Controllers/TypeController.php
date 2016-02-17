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
        $types = Type::all();

        return view('types.index', [
            'types' => $types,
        ]);
    }

    /**
    * Show create form
    */
    public function create(){

    }
}
