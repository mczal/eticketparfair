<?php
  namespace App\Repositories;

  use App\Order;

  class ConfirmationRepositories{


    public function forOrder(Order $order){
        return Confirmation::where('order_id', $order->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }

  }

 ?>
