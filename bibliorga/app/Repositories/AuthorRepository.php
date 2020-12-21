<?php
/**
 * Created by IntelliJ IDEA.
 * User: babdo
 * Date: 22/12/2018
 * Time: 17:56
 */

namespace App\Repositories;


use App\Models\Author;

class AuthorRepository extends ResourceRepository
{
    public function __construct(Author $model)
    {
        $this->model = $model;
    }
}
