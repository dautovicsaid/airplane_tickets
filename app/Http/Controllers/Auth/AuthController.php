<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Create an instance of AuthController
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.verify', ['except' => ['login', 'register']]);
    }

    /**
     * Register a User
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request) : JsonResponse
    {
        $user = User::create($request->validated());

        return response()->json([
            'message' => 'User registered successfully',
            'user' => User::find($user->id),
        ], 201);
    }

    /**
     * Get a JWT token after successful login
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request) : JsonResponse
    {
        if (!$token = JWTAuth::attempt($request->validated())) {
            return response()->json(['status' => 'failed', 'message' => 'Invalid email and password.', 'error' => 'Unauthorized'], 401);
        }

        return $this->getLoginResponse($token);
    }

    /**
     * Get the token array structure.
     * @param  string $token
     * @return JsonResponse
     */
    protected function getLoginResponse(string $token) : JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            //  'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth()->user(),
        ]);
    }

    /**
     * Refresh a JWT token
     * @return JsonResponse
     */

    /**
     * Get the Auth user using token.
     * @return JsonResponse
     */
    public function user() : JsonResponse
    {
        return response()->json(auth()->user());
    }

    /**
     * Logout user (Invalidate the token).
     * @return JsonResponse
     */
    public function logout() : JsonResponse
    {
        auth()->logout();
        return response()->json(['status' => 'success', 'message' => 'User logged out successfully']);
    }
}
