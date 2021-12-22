<?php

namespace App\Http\Middleware;

use Closure;

class AdminCheck
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
        if (!session()->has('user_id')) {
            return redirect('/login')->with('message', 'You must be logged In!');            
        }
        else if (session()->has('user_id')) {
            $user = \App\User::where('id', session('user_id'))->first();
            if ($user->email_verified_at == null) {
                return redirect('/login')->with('message', 'You must be Verified, kindly check your Email!');
            }

        }
        
        return $next($request);
    }
}
