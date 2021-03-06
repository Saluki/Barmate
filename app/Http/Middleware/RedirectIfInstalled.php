<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfInstalled
{
    const INSTALLATION_FILE = 'install.lock';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Installation lock disabled, we can't run the install process anymore
        if (!file_exists(base_path() . '/' . self::INSTALLATION_FILE)) {
            return redirect('/');
        }

        return $next($request);
    }
}
