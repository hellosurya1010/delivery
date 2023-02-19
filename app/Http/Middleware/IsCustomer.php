<?php

namespace App\Http\Middleware;

use App\Http\Resources\UserShortResource;
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
        $user = auth()->user();
        if($user->role == User::$customer){
            return $next($request);
        }
        if (request()->wantsJson()) {
            return (new ResponseService)
            ->devMessage("This URI only can be accessible for Customer role only.")
            ->data(['current_user' => new UserShortResource($user)])
            ->errors(true)
            ->code(401)
            ->message('Unauthorised.')
            ->getResponse();
        }
    }
}
