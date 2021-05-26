<?php

namespace App\Http\Middleware;

use Closure;
use App\Product;

class IsProduct
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
        $products = Product::where('slug', $request->route('slug'))->count();
        if ($products) {
            return $next($request);
        }
        return false;
    }
}
