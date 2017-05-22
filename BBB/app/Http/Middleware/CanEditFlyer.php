<?php

namespace App\Http\Middleware;

use App\Photo;
use Closure;

class CanEditFlyer
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
        dd($request->all());
        return $next($request);

        // $flyer = Photo::find($request->id)->flyer;
        // $user = $request->user();
        // if ( $user && $user->owns($flyer) ) {
        //     return $next($request);
        // }
        // return redirect('/');
    }
}
