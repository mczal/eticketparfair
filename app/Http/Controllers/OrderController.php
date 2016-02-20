<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Order;
use App\Repositories\OrderRepositories;

class OrderController extends Controller
{

    protected $orders;

    /**
    * Create a new controller instance.
    *
    * @param  OrderRepositories  $orders
    * @return void
    */
    public function __construct(OrderRepositories $orders){
        $this->orders = $orders;
    }

    /**
    * Types list view
    * @param Request
    */
    public function index(Request $request){
        $orders = Order::paginate(15);

        return view('orders.index', [
            'keyword' => '',
            'orders' => $orders,
        ]);
    }

    public function create(){
        return view('orders.create');
    }

    public function edit(){

    }

    public function destroy(){

    }

    /**
    * Process create form
    */
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'email' => 'required|unique:orders|email',
            'handphone' => 'required',
            'id_type' => 'required',
            'id_no' => 'required',
            'quantity' => 'required|numeric|min:1|max:3',
        ]);

        $order = new Order;
        $order->fill($request->all());
        $order->no_order = $this->orders->generateNoOrder();
        $order->expired_date = date('Y-m-d H:i:s', time() + (3600 * 10)); //10 hours
        $order->status = 1;
        $order->total_price = 0; //TODO: count the total
        $order->save();

        //TODO: sent email to customer
        Mail::send('emails.order', ['order' => $order], function($m) use ($order){
            $m->from('wilianto.indra@gmail.com', 'Parahyangan Fair');
            $m->to($order->email, $order->name);
            $m->subject('Thank you for order');
        });

        return redirect('/orders')->with('success_message', 'Order #<b>' . $order->no_order . '</b> was created.');
    }
}
