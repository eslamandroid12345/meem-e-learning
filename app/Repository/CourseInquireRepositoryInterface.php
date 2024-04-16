<?php

namespace App\Repository;

interface CourseInquireRepositoryInterface extends RepositoryInterface
{

    public function getCourseInquiries($id);

    public function getManagerInquiries();

    public function inquiriesCount();
}
