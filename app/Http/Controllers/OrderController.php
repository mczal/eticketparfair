<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
    * Types list view
    * @param Request
    */
    public function index(Request $request){
        return view('orders.index', [
            'keyword' => '',
        ]);
    }

    public function create(){
        return view('orders.create');
    }

    public function edit(){

    }

    public function destroy(){

    }
}
