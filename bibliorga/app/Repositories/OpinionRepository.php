<?php
/**
 * Created by IntelliJ IDEA.
 * User: babdo
 * Date: 23/12/2018
 * Time: 14:05
 */

namespace App\Repositories;


use App\Models\Opinion;
use App\Repositories\ResourceRepository;

class OpinionRepository extends ResourceRepository
{
    public function __construct(Opinion $model)
    {
        $this->model = $model;
    }
}
