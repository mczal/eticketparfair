<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //
    public $timestamps = false;

    public function order(){
      return $this->belongsTo('Order');
    }

    public function type(){
      return $this->belongsTo('Type');
    }
}
