<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function createUser(Request $request){
    	$user = new User;
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->password = $request->password;
    	$user->phone = $request->phone;
        $user->verify = $request->verify;
        $user->save();
        return response()->json($user);
    }

    public function showUser($id){
    	$user = User::findOrFail($id);
    	return response()->json($user);
    }

    public function listUser(){
    	$user = User::all();
    	return response()->json([$user]);
    }

    public function updateUser(Request $request, $id){
    	$user = User::findOrFail($id);
    	if($request->name){
    		$user->name = $request->name;
    	}
    	if($request->email){
    		$user->email = $request->email;
    	}
    	if($request->password){
    		$user->password = $request->password;
    	}
    	if($request->phone){
    		$user->phone = $request->phone;
    	}
    	if($request->verify){
    		$user->verify = $request->verify;
    	}
    	$user->save();
    	return response()->json([$user]);
    }

    public function deleteUser($id){
    	User::destroy($id);
    	return response()->json(['Usuário deletado']);
    }

    public function switchToAdvertiser($id) {
    	$user = User::findOrFail($id);
 		$user->verify = 1;
 		$user->save();
 		return response()->json(['Usuário virou ANUNCIANTE']);
 	}
}
