<?php

namespace App\Http\Middleware;

use Closure;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Validator;
use App\Models\UserStore;
use App\Http\Requests\UpdateUserStoreRequest;

class UserHasStoreMiddleware
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
        if (!$request->user()->hasCompleteStoreProfile()) {
            alert()->info('Completa los datos de tu tienda para continuar');
            return redirect('/account/profile');
        }

        return $next($request);
    }
}
