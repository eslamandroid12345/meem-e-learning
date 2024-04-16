<?php

namespace App\Repository;

interface CourseAttachmentRepositoryInterface extends RepositoryInterface
{

    public function getCourseAttachments($id);

}
