<?php

namespace App\Repositories;

use App\Models\Post;


class PostRepository extends BaseRepository {
    

    protected $model;


    public function __construct(Post $model) {
        parent::__construct($model);
    }


    public function getAll() {
        return $this->fetchAll();
    }


    public function find($id) {
        return $this->findById($id);
    }


    public function createPost($data) {
        return $this->create($data);
    }


    public function updatePost($id, $request){
        return $this->update($request->all(), $id);
    }


    public function deletePost($id) {
        return $this->delete($id);
    }


    public function getFilteredPost(array $filters) {
        $query = Post::query();

        if (isset($filters['title'])) {
            $query->where('title', 'LIKE', '%' . $filters['title'] . '%');
        }
        if (isset($filters['review'])) {
            $query->where('review', 'LIKE', '%' . $filters['review'] . '%');
        }
        if (isset($filters['rate'])) {
            $query->where('rate', $filters['rate']);
        }
        return $query->paginate(request()->input('pagination'));
    }
}

