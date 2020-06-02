<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\Project;

class checkAssigned
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
        /*$id = $request->id;
        if(Project::find($id)->assigned_users(Auth::user()->id)->admin == false){
            return ' Not authorized';
        }*/
        return $next($request);
    }
}
