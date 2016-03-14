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
use App\Repositories\TicketRepositories;

class OrderController extends Controller
{

    protected $orders;
    protected $types;
    protected $tickets;

    /**
    * Create a new controller instance.
    *
    * @param  OrderRepositories  $orders
    * @return void
    */
    public function __construct(OrderRepositories $orders, TypeRepositories $types, TicketRepositories $tickets){
        $this->middleware('auth');
        $this->orders = $orders;
        $this->types = $types;
        $this->tickets = $tickets;
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
        $timeLeft = "";
        if($order->expired_date != null){
          $timeLeft = round((strtotime($order->expired_date) - strtotime(date('Y-m-d H:i:s')))/60);
          //dd($timeLeft);
        }
        //dd($timeLeft);
        return view('orders.show', [
            'order' => $order,
            'timeLeft' => $timeLeft,
        ]);
    }

    public function edit(){
        //saat ini belum dibutuhkan
    }

    /**
    * Delete the selected data
    */
    public function destroy($id){

        $order = $this->getModel($id);
        $order->delete();

        return redirect('/orders')->with('success_message', 'Order <b>#' . $order->no_order . '</b> was deleted.');
    }

    /**
    * Process create form
    */
    public function store(Request $request){
        $this->validate($request, [
            'type_id' => 'required|integer',
            'name' => 'required',
            'email' => 'required|unique:orders|email',
            'id_no' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        //find type
        $type = $this->types->findById($request->type_id);

        $remaining_tickets = $this->tickets->countTicketsRemaining($type->id);

        if($remaining_tickets < $request->quantity){
            return redirect('/orders/create')->with('error_message', 'Number of tickets remaining: <b>' . $remaining_tickets . '</b>');
        }

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
            $ticket->active_date = date('Y-m-d H:i:s');
            $ticket->save();
        }

        Mail::send('emails.order', ['order' => $order], function($m) use ($order){
            $m->from('wilianto.indra@gmail.com', 'Parahyangan Fair 2016');
            $m->to($order->email, $order->name);
            $m->subject('Thank you for order');
            foreach($order->tickets as $ticket){
                $pdf = $ticket->generatePDF(true);
                $m->attachData($pdf->output(), $ticket->unique_code.'.pdf');
            }
        });

        return redirect('/orders')->with('success_message', 'Order #<b>' . $order->no_order . '</b> was created.');
    }

    /**
    * Cancel every order which expire and detach their tickets
    */
    // public function cancel(){
    //     //TODO: find more effisien query technique
    //     $orders = $this->orders->getAllExpire();
    //     foreach($orders as $order){
    //         $order->status = Order::STATUS_EXPIRE;
    //         foreach($order->tickets as $ticket){
    //             $ticket->order_date = NULL;
    //             $ticket->order()->dissociate();
    //             $ticket->save();
    //         }
    //         $order->save();
    //         echo "ID #{$order->no_order} is expire. <br>";
    //
    //         //TODO: send email to customer, is it need?
    //     }
    // }

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

    /**
    * store order offline ticks
    *     --order stored with this method with automatically activate the ticket
    *
    */
    public function storeOffline(Request $request){
      $this->validate($request, [
          'name' => 'required',
          'email' => 'required|unique:orders|email',
          'id_no' => 'required',
          'unique_code' => 'required',
      ]);

      $ticket = $this->tickets->findByUniqueCode($request->unique_code);
      $ticket->active_date=date('Y-m-d H:i:s', time() + (3600 * 10));
      $ticket->order_date=date('Y-m-d H:i:s', time() + (3600 * 10));


      //dd($ticket->type->price);
      $order = new Order;
      $order->fill($request->all());
      $order->no_order = $this->orders->generateNoOrder();
      $order->expired_date = date('Y-m-d H:i:s', time() + (3600 * 10)); //10 hours
      $order->status = Order::STATUS_PAID; //langsung aktif
      $order->quantity = 1;
      $order->total_price = $ticket->type->price;

      $order->save();
      $ticket->order()->associate($order);
      //dd($ticket->order);
      $ticket->save();
      $order->type()->associate($ticket->type);
      $order->save();

      return redirect('/orders/create-offline')->with('success_message', 'Order #<b>' . $order->no_order . '</b> was created and active.');

    }

    public function createOffline(){
      //dd('ijal'); //debug section
      return view('orders.create-offline');
    }

    public function resendMailOnlineOrder(Request $request){
      $order = $this->orders->findById($request->id);
      //dd($order);
      $atPrice = $order->type->price;
      //dd($atPrice);
      Mail::send('emails.order', ['order' => $order , 'atPrice' => $atPrice], function($m) use ($order){
          $m->from('admin@parahyanganfair.com', 'Parahyangan Fair 2016');
          $m->to($order->email, $order->name);
          $m->subject('Order Parahyangan Fair 2016');
      });

      return redirect('/orders');
    }


}
