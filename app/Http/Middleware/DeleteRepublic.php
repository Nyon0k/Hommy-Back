<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Republic;

class DeleteRepublic
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        $republics = Republic::with('user')->where('user_id',$user->id)->where('id', $request->id)->first();
        //$republics = User::with('republics')->where('id',$user->id)->where('republic_id',$)->first();
        if($republics){
            return $next($request);
        }
        else{
            return response()->json(['Essa republica não pertence a este usuario!']);
        }
    }
}
