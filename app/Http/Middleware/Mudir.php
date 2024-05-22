<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class Mudir
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
        $user = Auth::user();
        $selection_role = $user->selected_role;
        $data = json_decode($user->data);
        if (isset($user) && isset($selection_role)) {
            if ($selection_role == "department" && $data->type == "employee") {
                return $next($request);
            }else{
                abort(404);
            }
        } else
            abort(404);
    }
}
