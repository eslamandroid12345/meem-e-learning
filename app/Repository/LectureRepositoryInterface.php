<?php

namespace App\Repository;

interface LectureRepositoryInterface extends RepositoryInterface
{
    public function isAuthorizedToEmbed($id);
}
