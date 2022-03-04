<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseInterfaceRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll(array $relationships = [])
    {
        return $this->model->with($relationships)->get();
    }

    public function getFind($id, array $relationships = [])
    {
        return $this->model->with($relationships)->find($id);
    }

    public function getByField(array $fields, array $relationships = [])
    {
        return $this->model->with($relationships)->where($fields)->first();
    }

    public function getByFields(array $fields, array $relationships = [])
    {
        return $this->model->with($relationships)->where($fields)->get();
    }

    public function getToArray(array $fields, $column, array $relationships = [])
    {
        return $this->model->with($relationships)->where($fields)->pluck($column)->toArray();
    }

    public function getSum(array $fields, array $relationships = [])
    {
        return $this->model->with($relationships)->where($fields);
    }

    public function setDelete($id)
    {
        return $this->model->find($id)->delete();
    }
}
