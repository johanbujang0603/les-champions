<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\Models\Installation;
use Illuminate\Http\Request;

class CheckInstallation
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $installation = Installation::whereUuid($request->header(config('app.installation_header')))->first();

        abort_if(! $installation, 403, 'You must provide a valid' .config('app.installation_header').' header.');

        if ($user_id = Auth::id()) {
            abort_if($user_id != $installation->user_id, 403, 'Your user and installation do not match.');
        }

        $request->attributes->add(['installation_id' => $installation->uuid]);

        return $next($request);
    }
}
