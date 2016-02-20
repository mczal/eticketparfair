<?php
namespace App\Repositories;

use App\Order;

class OrderRepositories{
    public function generateNoOrder(){
        $order = Order::where('created_at', 'like', date('Y-m-d').'%')->count();
        $number = date('ymd') . str_pad($order + 1, 4, '0', STR_PAD_LEFT);
        return $number;
    }
}
