<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //
    public function order(){
      return $this->belongsTo('Order');
    }
}
