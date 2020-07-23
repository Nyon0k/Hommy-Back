<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Republic;

class RepublicController extends Controller
{
    public function createRepublic(Request $request){
    	$republic = new Republic;
    	$republic -> name = $request -> name;
    	$republic -> adress = $request -> adress;
    	$republic -> freeBedrooms = $request -> freeBedrooms;
    	$republic -> telephone = $request ->	telephone;
    	$republic -> price = $request -> price;
    	$republic -> save();
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

    public function updateRepublic(Request $request, $id){
    	$republic = Republic::findOrFail($id);
    	if($request -> name){
    		$republic -> name = $request -> name;
    	}
    	if($request -> adress){
    		$republic -> adress = $request -> adress;
    	}
    	if($request -> freeBedrooms){
    		$republic -> freeBedrooms = $request -> freeBedrooms;
    	}
    	if($request -> telephone){
    		$republic -> telephone = $request -> telephone;
    	}
    	if($request -> price){
    		$republic -> price = $request -> price;
    	}
    	$republic -> save();
    	return reponse()->json([$republic]);
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
}
