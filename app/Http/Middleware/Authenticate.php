<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }

    protected function unauthenticated($request, array $guards)
    {
        if ($request->expectsJson()) {
            abort(response()->json(['message' => 'Unauthenticated.'], 401));
        }

        return redirect()->guest($this->redirectTo($request));
    }
}
