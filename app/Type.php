<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public $timestamps = false;

    //
    public function tickets(){
      return $this->hasMany(Ticket::class);
    }
}
