<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Republic;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\RepublicFormRequest;
use App\Http\Resources\Republics as RepublicsResource;

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
    	$republic = Republic::paginate(4);
    	return response()->json($republic);
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

    public function searchRepublic(Request $request) { 
        $queryRepublic = Republic::query(); // Gera um objeto do tipo Builder
        if ($request->name)
            $queryRepublic->where('name','LIKE', '%'.$request->name.'%');
        if ($request->freeBedrooms)
            $queryRepublic->where(freeBedrooms);
        $paginator = $queryRepublic->paginate(4);
        $search = RepublicsResource::collection($paginator);
        $last = $paginator->lastPage();
        return response()->json([$search, $last]);
    }

    public function deleteRepublic($id){
    	Republic::destroy($id);
    	return response()->json(['Republica deletada']);
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

    public function republicasDeletadas(){
        $republic = Republic::onlyTrashed()->get();
        return response()->json($republic);
    }

    public function restoreOneRepublic($id){
        $republic = Republic::onlyTrashed()->findOrFail($id);
        $republic->restore();
        return response()->json($republic);
    }

    public function restoreRepublics(){
        $republic1 = Republic::onlyTrashed()->get();
        $republic2 = Republic::onlyTrashed()->restore();
        return response()->json($republic1);
    }

    public function countUserRepublics(Request $request) {
        $id = $request->id;
        $user = Republic::with('users')->where('user_id',$id)->count();
        return response()->json($user);
    }

}
