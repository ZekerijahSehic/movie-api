<?php

namespace App\Repositories;

use App\Models\Movie;


class MovieRepository extends BaseRepository {


    protected $model;


    public function __construct(Movie $model) {
        parent::__construct($model);
    }


    public function getAll() {
        return $this->fetchAll();
    }


    public function find($slug) {
        return $this->findById($slug);
    }


    public function createMovie($data) {
        return $this->create($data);
    }


    public function updateMovie($id, $request){
        return $this->update($request->all(), $id);
    }

    public function deleteMovie($id) {
        return $this->delete($id);
    }


    public function getFilteredMovies(array $filters) {
        $query = Movie::query();

        if (isset($filters['title'])) {
            $query->where('title', 'LIKE', '%' . $filters['title'] . '%');
        }
        if (isset($filters['plot_summary'])) {
            $query->where('plot_summary', 'LIKE', '%' . $filters['plot_summary'] . '%');
        }
        if (isset($filters['release_year'])) {
            $query->where('release_year', $filters['release_year']);
        }
        if (isset($filters['duration_minutes'])) {
            $query->where('duration_minutes', '>=', $filters['duration_minutes']);
        }
        return $query->paginate(request()->input('pagination'));
    }
}

