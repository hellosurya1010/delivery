<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Services\ResponseService;
use Closure;
use Illuminate\Http\Request;

class IsCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->role == User::$customer){
            return $next($request);
        }
        return (new ResponseService)
        ->devMessage("This URI only can be accessible for Customer role only.")
        ->errors(true)
        ->code(401)
        ->message('Unauthorised.')
        ->getResponse();
    }
}
