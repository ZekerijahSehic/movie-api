<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use App\Models\Role;
use App\Models\User;


class UserController extends Controller {

    public function __construct(
        private UserRepository $userRepository) {}


    public function index(Request $request): JsonResponse { 
        $filters = $request->only(['username']);
        $response = new JsonResponse();
        
        if(!empty($filters)) {
            $users = $this->userRepository->getFilteredUser($filters);
            $response = response()->json($users);
        } else {
            $users = $this->userRepository->getAll();
            $response = response()->json($users);
        }
        return $response;
    }


    public function show(User $user): JsonResponse {
        return response()->json($user);
    }


    public function update(User $user, Request $request): JsonResponse {
        $user = $this->userRepository->updateUser($user->id, $request);
        return response()->json($user);
    }


    public function destroy(User $user): JsonResponse {
        $this->userRepository->deleteUser($user->id);
        return response()->json();
    }

    
    public function favorites(Request $request): JsonResponse {
        $user = $request->user();
        $favorites = $user->favoriteMovies()->get();
        return response()->json($favorites);
    }
}
