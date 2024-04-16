<?php

namespace App\Repository;

interface CourseBookRepositoryInterface extends RepositoryInterface
{

    public function filterStoreBooks($perPage = 25 , array $columns = ['*'], array $relations = [] , $orderBy = 'DESC');
    public function getCourseBooks($id);

    public function isExisted($course_book_id);
    public function getProfileBooks();
}
