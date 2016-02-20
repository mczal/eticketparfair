<?php
namespace App\Repositories;

use App\Order;

class OrderRepositories{
    /**
    * Generate no_order
    * @return string
    */
    public function generateNoOrder(){
        $order = Order::where('created_at', 'like', date('Y-m-d').'%')->count();
        $number = date('ymd') . str_pad($order + 1, 4, '0', STR_PAD_LEFT);
        return $number;
    }

    /**
    * Find order by id
    * @param $id integer
    * @return Order
    */
    public function findById($id){
        $order = Order::where(['id' => $id])->first();
        return $order;
    }

    /**
    * Get all data by selected filter and pagination
    * @return Order[]
    */
    public function getAllFiltered($keyword = ''){
        if(!empty($keyword)){
            $orders = Order::where('no_order', $keyword)->paginate(10);
        }else{
            $orders = Order::paginate(10);
        }

        return $orders;
    }

    /**
    * Get all datas which are expire
    * @return Order[]
    */
    public function getAllExpire(){
        $orders = Order::where('expired_date', '<=', date('Y-m-d H:i:s'))
                    ->where('status', Order::STATUS_ORDERED)
                    ->get();
        return $orders;
    }
}
