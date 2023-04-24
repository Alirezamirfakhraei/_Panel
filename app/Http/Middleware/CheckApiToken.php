<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Users\Models\User;
use Symfony\Component\HttpFoundation\Response;

class CheckApiToken
{
    public function handle($request, Closure $next)
    {
        if (!empty(trim($request->input('api_token')))) {
            $is_exists = User::query()->where('id', Auth::guard('api')->id())->exists();
            if ($is_exists) {
                return $next($request);
            }
        }
        return response()->json('Invalid Token', 401);
    }
}
