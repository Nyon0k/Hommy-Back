<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserRequest;
use App\User;
use Auth;
use DB;

class PassportController extends Controller
{
    public function register(UserRequest $request)
    {
        $newuser = new User;
        $newuser->createUser($request);
        $success['token'] = $newuser->createToken('MyApp')->accessToken;
        return response()->json(['success' => $success, 'user' => $newuser], 200);
    }
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success, 'user' => $user], 200);
        } else {
            return response()->json(['error' => 'Unauthorized', 'status' => 401]);
        }
    }
    public function getDetails(){
        $user = Auth::user();
        return response()->json(['success'=> $user], 200);
    }
    public function logout(){
        $accessToken = Auth::user()->token();
        DB::table('oauth_refresh_tokens')->where('access_token_id', $accessToken->id)->update(['revoked'=>true]);
        $accessToken->revoke();
        return response()->json(['usuário deslogado'], 200);
    }
}