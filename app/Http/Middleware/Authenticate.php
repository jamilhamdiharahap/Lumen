<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\Key;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $token = $request->bearerToken();
        if (!$token) {
            return response(['message' => 'Unauthorized.'], 401);
        }
        try {
            $credentials = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
        } catch (Exception  $e) {
            return response([
                'error' => $e->getMessage()
            ], 400);
        }
        $user = User::find($credentials->data->id);
        $request->auth = $user;
        return $next($request);
    }
}
