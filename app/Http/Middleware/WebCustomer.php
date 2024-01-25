<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
use Session;
class WebCustomer
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @param  string|null  $guard
	 * @return mixed
	 */
	public function handle($request, Closure $next, $guard = 'customer')
	{
	    if (Session::has('supportUserDetails')) {
	      return $next($request);
	    }
	    return redirect()->back()->with('middleWareloginError', "Not login");
    }
}
