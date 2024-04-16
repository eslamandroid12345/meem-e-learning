<?php

namespace App\Repository;

interface FieldRepositoryInterface extends RepositoryInterface
{

    public function getCommonQuestions($courseId);

    public function getNavbarFields();

}
