<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class UserFirm
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
        $user = User::where('id', \Auth::id())->with('userSettings')->first();
        if(empty($user->userSettings->firm_id) || $user->userSettings->firm_id < 1){
            return redirect('/firm')->with('status', 'You must complete your firm setup.');
        } 
        return $next($request);
    }
}
