<?php

namespace App\Http\Middleware\Api;

use App\Models\User;
use App\Services\AuthService;
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
        $role = User::$customer;
        if (auth()->user()->role == $role) {
            return $next($request);
        }
        return (new ResponseService)
            ->message("Error")
            ->errors(true)
            ->devMessage("This API URI is belongs to $role.")
            ->getResponse();
    }
}
