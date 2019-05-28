<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use Laravel\Passport\Client;

class PasswordGrantClientMiddleware
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
        $client = Client::where('password_client', 1)->first();

        View::share('client', $client);

        return $next($request);
    }
}
