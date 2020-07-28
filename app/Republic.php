<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Republic extends Model
{
	public function removeUsuario(){
		$this->user_id = NULL;
		$this->save();
	}

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function userLocatario(){
    	return $this->hasOne('App\User');
    }

    public function republicaFavoritada(){
    	return $this->belongsToMany('App\User');
    }
}
