<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use User;

class Republic extends Model
{
    public function user(){
        return $this->belongsTo('User');
    }
}
