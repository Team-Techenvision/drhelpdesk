<?php

namespace App\Http\Middleware;

use Closure;
use App\Category;
use \Illuminate\Http\Request;

class IsCategory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $category = Category::where('slug', $request->route('slug'))->count();
        if ($category) {
            return $next($request);
        }
        return abort(403);
    }
}
