<?php

namespace App\Http\Middleware;

use App\Traits\API\apiTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserType {
    use apiTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$types): Response {
        $user = auth()->user();
        if (!$user || !in_array($user->type, $types)) {
            return $this->errorResponse('Unauthorized.', 403);
        }
        return $next($request);
    }
}
