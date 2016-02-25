<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Order;
use App\Ticket;
use App\Repositories\OrderRepositories;
use App\Repositories\TypeRepositories;

class OrderController extends Controller
{

    protected $orders;
    protected $types;

    /**
    * Create a new controller instance.
    *
    * @param  OrderRepositories  $orders
    * @return void
    */
    public function __construct(OrderRepositories $orders, TypeRepositories $types){
        $this->middleware('auth');
        $this->orders = $orders;
        $this->types = $types;
    }

    /**
    * Types list view
    * @param Request
    */
    public function index(Request $request){
        $keyword = $request->keyword;
        $orders = $this->orders->getAllFiltered($keyword);

        return view('orders.index', [
            'keyword' => $keyword,
            'orders' => $orders,
        ]);
    }

    /**
    * Show create form
    */
    public function create(){
        $types = $this->types->getAllActive();
        return view('orders.create', [
            'types' => $types,
        ]);
    }

    /**
    * Show data id
    */
    public function show($id){
        $order = $this->getModel($id);
        return view('orders.show', [
            'order' => $order,
        ]);
    }

    public function edit(){
        //saat ini belum dibutuhkan
    }

    /**
    * Delete the selected data
    */
    public function destroy(){
        $order = $this->getModel($id);
        $order->delete();

        return redirect('/orders')->with('success_message', 'Order <b>#' . $type->no_order . '</b> was deleted.');
    }

    /**
    * Process create form
    */
    public function store(Request $request){
        $this->validate($request, [
            'type_id' => 'required|integer',
            'name' => 'required',
            'address' => 'required',
            'email' => 'required|unique:orders|email',
            'handphone' => 'required',
            'id_type' => 'required',
            'id_no' => 'required',
            'quantity' => 'required|integer|min:1|max:3',
        ]);

        //find type
        $type = $this->types->findById($request->type_id);

        //TODO: check ticket remaining

        //save order
        $order = new Order;
        $order->fill($request->all());
        $order->no_order = $this->orders->generateNoOrder();
        $order->expired_date = date('Y-m-d H:i:s', time() + (3600 * 10)); //10 hours
        $order->status = 1;
        $order->total_price = ($type->price * $order->quantity) + rand(1, 999);
        $order->save();

        //TODO: make safer saving technique with transaction
        //set to ticket
        $tickets = Ticket::where('type_id', $type->id)
                        ->where('order_date', NULL)
                        ->limit($order->quantity)
                        ->get();

        foreach($tickets as $ticket){
            $ticket->order()->associate($order);
            $ticket->order_date = date('Y-m-d H:i:s');
            $ticket->save();
        }

        Mail::send('emails.order', ['order' => $order], function($m) use ($order){
            $m->from('wilianto.indra@gmail.com', 'Parahyangan Fair');
            $m->to($order->email, $order->name);
            $m->subject('Thank you for order');
        });

        return redirect('/orders')->with('success_message', 'Order #<b>' . $order->no_order . '</b> was created.');
    }

    /**
    * Cancel every order which expire and detach their tickets
    */
    public function cancel(){
        //TODO: find more effisien query technique
        $orders = $this->orders->getAllExpire();
        foreach($orders as $order){
            $order->status = Order::STATUS_EXPIRE;
            foreach($order->tickets as $ticket){
                $ticket->order_date = NULL;
                $ticket->order()->dissociate();
                $ticket->save();
            }
            $order->save();
            echo "ID #{$order->no_order} is expire. <br>";

            //TODO: send email to customer, is it need?
        }
    }

    /**
    * Get order model by Id
    * @return Order
    */
    private function getModel($id){
        $model = $this->orders->findById($id);

        if($model === null){
            abort(404);
        }

        return $model;
    }
}
