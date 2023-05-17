<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddMovieRequest;
use App\Repositories\MovieRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\User;


class MovieController extends Controller {
    

    public function __construct(
        private MovieRepository $movieRepository,
        private UserRepository $userRepository) {}


    public function index(Request $request): JsonResponse { 
        $filters = $request->only(['title', 'plot_summary', 'release_year', 'duration_minutes']);
        $response = new JsonResponse();
        
        if(!empty($filters)) {
            $movies = $this->movieRepository->getFilteredMovies($filters);
            $response = response()->json($movies);
        } else {
            $movies = $this->movieRepository->getAll();
            $response = response()->json($movies);
        }
        return $response;   
    }


    public function store(AddMovieRequest $request): JsonResponse {
        $movie = $this->movieRepository->createMovie($request->all());
        return response()->json($movie);
    }


    public function show(Movie $movie): JsonResponse {
        return response()->json($movie);
    }


    public function update(Movie $movie, Request $request): JsonResponse {
        $movie = $this->movieRepository->updateMovie($movie->id, $request);
        return response()->json($movie);
    }


    public function destroy(Movie $movie): JsonResponse {
        $this->movieRepository->deleteMovie($movie->id);
        return response()->json();
    }


    public function getMoviesByUser($slug): JsonResponse {
        $user = User::where('slug', $slug)->firstOrFail();
        $movies = $user->load('posts');
        return response()->json($movies);
    }


    public function getMoviePosts(Movie $movie): JsonResponse {
        return response()->json($movie->load('posts'));        
    }


    public function favorite(Movie $movie): JsonResponse {
        $user = auth()->user();
        $alreadyFavourited = $user->favoriteMovies()->wherePivot('movie_id', $movie->id)->exists();
        $response = new JsonResponse;

        if(!$alreadyFavourited) {
            $user->favoriteMovies()->attach($movie->id);
            $response = response()->json(['message' => $movie->title . " added to your favorite list!"]);
        } else {
            $user->favoriteMovies()->detach($movie->id);
            $response = response()->json(['message' => $movie->title . " removed from your favorite list!"]);
        }

        return $response;
    }
}