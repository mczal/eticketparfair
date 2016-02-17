<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public function orders(){
      return $this->hasMany('Ticket');
    }

    pubilc function confirmation(){
      return $this->hasOne('Confirmation');
    }
}
