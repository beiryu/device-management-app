<?php
namespace App\Repositories;

trait Repository {

    public function getAll($model, $needInstance = null) {
        return ($needInstance) ? $model::latest() : $model::all();
    }

    public function where($model, $collection, $operator = '=') {
        $query = $model;
        foreach($collection as $key => $value) {
            $query = $query->where($key, $operator, $value);
        }
        return $query;
    }

    public function saveToStore($model, $collection) {
        $model::create($collection);
    }
}