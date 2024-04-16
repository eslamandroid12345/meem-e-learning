<?php

namespace App\Repository;

interface LecturePinRepositoryInterface extends RepositoryInterface
{
    public function getByLectureId($id);
}
