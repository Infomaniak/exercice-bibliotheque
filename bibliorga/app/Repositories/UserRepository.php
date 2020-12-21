<?php
/**
 * Created by IntelliJ IDEA.
 * User: babdo
 * Date: 20/06/2018
 * Time: 17:48
 */

namespace App\Repositories;

use App\Models\User;

class UserRepository extends ResourceRepository
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
