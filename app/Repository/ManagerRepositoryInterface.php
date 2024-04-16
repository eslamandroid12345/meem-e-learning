<?php

namespace App\Repository;

interface ManagerRepositoryInterface extends RepositoryInterface
{
    public function getManagers($role , array $columns);
    public function getCooperators(array $columns);
    public function getTeachersCount();

}
