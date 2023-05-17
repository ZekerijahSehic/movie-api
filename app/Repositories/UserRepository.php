<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use App\Models\User;


class UserRepository extends BaseRepository {


    protected $model;


    public function __construct(User $model) {
        parent::__construct($model);
    }


    public function getAll() {
        return $this->fetchAll();
    }


    public function find($slug) {
        return $this->findById($slug);
    }


    public function createUser($data) {
        $username = $data['username'];
        $slug = Str::slug($username);
        $data['slug'] = $slug;
        return $this->create($data);
    }


    public function updateUser($id, $request){
        if($request['username']){
            $username = $request['username'];
            $slug = Str::slug($username);
            $request['slug'] = $slug;
        }
        return $this->update($request->all(), $id);
    }


    public function deleteUser($id) {
        return $this->delete($id);
    }


    public function getFilteredUser(array $filters) {
        $query = User::query();

        if (isset($filters['username'])) {
            $query->where('username', 'LIKE', '%' . $filters['username'] . '%');
        }
        return $query->paginate(request()->input('pagination'));
    }
}
