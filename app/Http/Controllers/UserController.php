<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserRequest;
use App\Republic;
use App\Http\Resources\User as UserResource;

class UserController extends Controller
{
    public function createUser(UserRequest $request){
    	$user = new User;
    	$user->createUser($request);
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

    public function updateUser(UserRequest $request, $id){
    	$user = User::findOrFail($id);
    	$user->updateUser($request);
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

    public function alugar($user_id, $republic_id){
        $user = User::findOrFail($user_id);
        $user->alugar($republic_id);
        return response()->json($user);
    }

    public function removeAluguel($republic_id, $user_id){
        $republic = Republic::findOrFail($republic_id);
        $user = User::findOrFail($user_id);
        $user->removeAluguel();
        $republic->removeUsuario();
        return response()->json([$user, $republic]);
    }

    public function favoritarRep($user_id, $republic_id){
        $user = User::findOrFail($user_id);
        $user->repFavoritadaUser()->attach($republic_id);
        return response()->json(["S2"]);
    }

    public function desfavoritarRep($user_id, $republic_id){
        $user = User::findOrFail($user_id);
        $user->repFavoritadaUser()->detach($republic_id);
        return response()->json(["S/2"]);
    }

    public function listFavRep($id){
        $user = User::findOrFail($id);
        return response()->json($user->repFavoritadaUser);
    }
}
