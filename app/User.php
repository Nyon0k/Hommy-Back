<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Republic;
use App\Http\Requests\UserRequest;
Use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use HasApiTokens;
    use SoftDeletes;

    public function createUser(UserRequest $request){
        $this->name = $request->name;
        $this->email = $request->email;
        $this->password = bcrypt($request->password);
        $this->phone = $request->phone;
        $this->verify = $request->verify;
        $this->cpf = $request->cpf;
        $this->save();
    }

    public function updateUser(UserRequest $request, $id){
        if($request->name){
            $this->name = $request->name;
        }
        if($request->email){
            $this->email = $request->email;
        }
        if($request->password){
            $this->password = $request->password;
        }
        if($request->phone){
            $this->phone = $request->phone;
        }
        if($request->verify){
            $this->verify = $request->verify;
        }
        if($request->cpf){
            $this->cpf = $request->cpf;
        }
        $this->save();
    }

    public function republic(){
        return $this->belongsTo('App\republic');
    }

    public function republics(){
        return $this->hasMany('App\Republic');
    }

    public function alugar($republic_id){
        $republic = Republic::findOrFail($republic_id);
        $this->republic_id = $republic_id;
        $this->save();
    }

    public function removeAluguel(){
        $this->republic_id = NULL;
        $this->save();
    }

    public function repFavoritadaUser(){
        return $this->belongsToMany('App\Republic');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
