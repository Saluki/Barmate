<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Guard;

class Administrator {

    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

	public function handle($request, Closure $next)
	{
        if ($this->auth->guest() || session('role')!=='ADMN' )
        {
            if ($request->ajax())
            {
                return response('Unauthorized.', 401);
            }
            else
            {
                return redirect()->guest('/');
            }
        }

		return $next($request);
	}

}
