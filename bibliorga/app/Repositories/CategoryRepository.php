<?php
/**
 * Created by IntelliJ IDEA.
 * User: babdo
 * Date: 22/12/2018
 * Time: 23:15
 */

namespace App\Repositories;


use App\Models\Category;

class CategoryRepository extends ResourceRepository
{
    public function __construct(Category $model)
    {
        $this->model = $model;
    }
}
