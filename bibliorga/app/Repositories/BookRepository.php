<?php
/**
 * Created by IntelliJ IDEA.
 * User: babdo
 * Date: 22/12/2018
 * Time: 22:25
 */

namespace App\Repositories;


use App\Models\Book;

class BookRepository extends ResourceRepository
{
    public function __construct(Book $model)
    {
        $this->model = $model;
    }
}
