<?php

namespace App\Repositories;

/**
 * Class ResourceRepository
 * @package App\Repositories
 */
abstract class ResourceRepository
{

    protected $model;

    /**
     * Paginate for the model
     * @param $n
     * @return mixed
     */
    public function getPaginate($n)
    {
        return $this->model->paginate($n);
    }

    public function store(Array $inputs)
    {
        return $this->model->create($inputs);
    }

    public function update($id, Array $inputs)
    {
        $this->getById($id)->update($inputs);
    }

    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function destroy($id)
    {
        $this->getById($id)->delete();
    }

}
