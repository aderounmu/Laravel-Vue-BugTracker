<?php

namespace App\Http\Middleware;

use Auth;
use App\Project;
use Closure;

class checkForAdmin
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
        // $id = $request->id;
        // if(Project::find($id)->assigned_users(Auth::user()->id)->admin == false){
        //     return ' Not authorized';
        // }else{
        //     return $next($request);
        // }

        return $next($request);
        
    }
}
