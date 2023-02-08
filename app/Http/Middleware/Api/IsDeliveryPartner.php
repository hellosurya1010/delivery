<?php

namespace App\Http\Middleware\Api;

use App\Models\User;
use App\Services\ResponseService;
use Closure;
use Illuminate\Http\Request;

class IsDeliveryPartner
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
        $role = User::$deliveryPartner;
        if (auth()->user()->role == $role) {
            return $next($request);
        }
        return (new ResponseService)
            ->message("Error")
            ->devMessage("This API URI is belongs to $role.")
            ->errors(true)
            ->getResponse();
    }
}
