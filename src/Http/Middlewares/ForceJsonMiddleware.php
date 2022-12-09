<?php
/**
 * Author: Theo Champion
 * Date: 09/12/2022
 * Time: 10:46
 */


namespace Lesignobles\BaseApiLaravel\Http\Middlewares;


use Closure;
use Illuminate\Http\Request;

class ForceJsonMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $request->headers->set('Accept', 'application/json');
        return $next($request);
    }
}
