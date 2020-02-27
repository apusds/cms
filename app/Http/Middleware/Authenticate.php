<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        if ($request->getRequestUri() === '/admin/*') {
            return redirect(route('admin.login'));
        }

        if ($request->getRequestUri() === '/member/*') {
            return redirect(route('member.login'));
        }

        return redirect(route('member.login'));
    }
}
