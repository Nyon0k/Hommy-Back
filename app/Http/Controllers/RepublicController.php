<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Republic;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\RepublicFormRequest;

class RepublicController extends Controller
{
    public function createRepublic(RepublicFormRequest $request){
    	$republic = new Republic;
        $republic->user_id = $request->user_id;
    	$republic->name = $request->name;
    	$republic->adress = $request->adress;
    	$republic->freeBedrooms = $request->freeBedrooms;
    	$republic->phone = $request->phone;
    	$republic->price = $request->price;
    	$republic->save();
    	return response()->json($republic);
    }

    public function showRepublic($id){
    	$republic = Republic::findOrFail($id);
    	return response()->json($republic);
    }

    public function listRepublic(){
    	$republic = Republic::all();
    	return response()->json([$republic]);
    }

    public function updateRepublic(RepublicFormRequest $request, $id){
    	$republic = Republic::findOrFail($id);
    	if($request->name){
    		$republic->name = $request->name;
    	}
    	if($request->adress){
    		$republic->adress = $request->adress;
    	}
    	if($request->freeBedrooms){
    		$republic->freeBedrooms = $request->freeBedrooms;
    	}
    	if($request->phone){
    		$republic->phone = $request->phone;
    	}
    	if($request->price){
    		$republic->price = $request->price;
    	}
    	$republic->save();
    	return response()->json([$republic]);
    }

    public function deleteRepublic($id){
    	Republic::destroy($id);
    	return response()->json(['Produto deletado']);
    }

    public function addRepublic($id, $republic_id){
    	$user = User::findOrFail($id);
    	$republic = Republic::findOrFail($republic_id);
    	$republic->user_id = $id;
    	$republic->save();
    	return response()->json($republic);
    }

    public function removeRepublic($id, $republic_id){
    	$user = User::findOrFail($id);
    	$republic = Republic::findOrFail($republic_id);
    	$republic->user_id = Null;
    	$republic->save();
    	return response()->json($republic);
    }

    public function locatarios($id){
        $republic = Republic::findOrFail($id);
        $locatarios = $republic->userLocatario->get();
        return response()->json($locatarios);
    }

    public function mostrarProprietario($id){
        $republic = Republic::findOrFail($id);
        $user = User::findOrFail($republic->user_id);
        return response()->json($user);
    }
}
