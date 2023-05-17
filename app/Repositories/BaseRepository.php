<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseInterface;
use Illuminate\Database\Eloquent\Model;


class BaseRepository implements BaseInterface {

    
    protected $model;


    public function __construct(Model $model) {
        $this->model = $model;
    }


    public function fetchAll() {
        return $this->model->paginate(request()->input('pagination'));
    }

    
    public function findById(int $id) {
        return $this->model->where('id', $id)->first();
    }


    public function create(array $attributes) {
        return $this->model->create($attributes);
    }


    public function update(array $params, int $id) {
        $model = $this->model->where('id', $id)->first();
        $model->update($params);
        return $model;
    }


    public function delete(int $id) {
        $model = $this->model->where('id', $id)->first();
        return $model->delete();
    }
}

