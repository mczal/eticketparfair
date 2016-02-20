<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public $timestamps = false;

    /**
    * Relation to Order model
    */
    public function order(){
        return $this->belongsTo(Order::class);
    }

    /**
    * Relation to Type model
    */
    public function type(){
        return $this->belongsTo(Type::class);
    }
}
