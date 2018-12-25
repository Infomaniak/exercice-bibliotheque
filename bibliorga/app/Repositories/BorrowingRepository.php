<?php
/**
 * Created by IntelliJ IDEA.
 * User: babdo
 * Date: 23/12/2018
 * Time: 18:19
 */

namespace App\Repositories;


use App\Models\Borrowing;

class BorrowingRepository extends ResourceRepository
{
    public function __construct(Borrowing $model)
    {
        $this->model = $model;
    }
}
