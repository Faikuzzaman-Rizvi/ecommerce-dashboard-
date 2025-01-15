<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DemoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $key=$request->key;

        if($key == "XYZ123"){

            return $next($request);

        }else{
            // return response()->json(['message'=>'Unauthorized'],401);
            // return redirect('/hello2');
            // return redirect()->route('/hello2');
            return response()->json(['message'=>'Unauthorized','status code'=>'401'], 401);
        }
    }
}
