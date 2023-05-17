<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller {

    public function __construct(
        private UserRepository $userRepository) {}


    public function register(AddUserRequest $request): JsonResponse {
        $request->merge(['role_id' => Role::USER]);
        $user = $this->userRepository->createUser($request->all());
        return response()->json($user);
    }


    public function login(LoginUserRequest $request): JsonResponse {
        $credentials = $request->only('email', 'password');

        if(!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid login credentials'], 401);
        }

        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['token' => $token], 200);
    }

    
    public function logout(Request $request): JsonResponse {
        $user = $request->user();

        if($user) {
            $user->tokens()->delete();
        }

        return response()->json(['User logged out.']);
    }
}

