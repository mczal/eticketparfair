<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //
    public $timestamps = false;

    public function order(){
      return $this->belongsTo(Order::class);
    }

    public function type(){
      return $this->belongsTo(Type::class);
    }
}
