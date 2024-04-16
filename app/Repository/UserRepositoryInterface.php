<?php

namespace App\Repository;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getCount();

    public function getByEmail($email);

    

}
