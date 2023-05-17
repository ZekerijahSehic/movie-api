<?php 

namespace App\Repositories\Interfaces;


interface BaseInterface {

    
    public function create(array $attributes);

    public function fetchAll();

    public function update(array $params,  int $id);

    public function delete(int $id);

    public function findById(int $id);
}




