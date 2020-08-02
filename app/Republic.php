<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
Use Illuminate\Database\Eloquent\SoftDeletes;

class Republic extends Model
{
    use SoftDeletes;

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
