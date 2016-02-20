<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use SoftDeletes;

    public $timestamps = false;

    /**
    * Relation to Ticket model
    */
    public function tickets(){
        return $this->hasMany(Ticket::class);
    }
}
