<?php
  namespace App\Repositories;

  use App\Ticket;
  use App\Order;
  use App\Type;

  class TicketRepositories{

    public function forType(Type $type){
        return Ticket::where('type_id', $type->id)
                    ->orderBy('id', 'asc')
                    ->get();
    }

    public function forOrder(Order $order){
        return Ticket::where('order_id', $order->id)
                    ->orderBy('id', 'asc')
                    ->get();
    }

  }

 ?>
