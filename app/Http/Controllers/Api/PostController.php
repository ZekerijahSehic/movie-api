<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddPostRequest;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;


class PostController extends Controller {

    public function __construct(
        private PostRepository $postRepository,
        private UserRepository $userRepository) {}


    public function index(Request $request): JsonResponse { 
        $filters = $request->only(['title', 'review', 'rate']);
        $response = new JsonResponse();
        
        if(!empty($filters)) {
            $posts = $this->postRepository->getFilteredPost($filters);
            $response = response()->json($posts);
        } else {
            $posts = $this->postRepository->getAll();
            $response = response()->json($posts);
        }
        return $response;
    }


    public function store(AddPostRequest $request): JsonResponse {
        $post = $this->postRepository->createPost($request->all());
        return response()->json($post);
    }


    public function show(Post $post): JsonResponse {
        return response()->json($post);
    }


    public function update(Post $post, Request $request): JsonResponse {
        $post = $this->postRepository->updatePost($post->id, $request);
        return response()->json($post);
    }


    public function destroy(Post $post): JsonResponse {
        $this->postRepository->deletePost($post->id);
        return response()->json();
    }

    
    public function getPostsByUser($slug): JsonResponse {
        $user = User::where('slug', $slug)->firstOrFail();
        $posts = $user->load('posts');
        return response()->json($posts);
    }
}

