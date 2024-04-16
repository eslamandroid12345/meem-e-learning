<?php

namespace App\Http\Services\Api\CategoryField;


use App\Http\Resources\Field\Web\FieldResource;
use App\Http\Services\Mutual\GetService;
use App\Repository\CourseBookRepositoryInterface;
use App\Repository\FieldRepositoryInterface;

abstract class CategoryFieldService
{
    protected GetService $get;
    protected CourseBookRepositoryInterface $courseBookRepository;
    protected FieldRepositoryInterface $fieldRepository;

    public function __construct(CourseBookRepositoryInterface $courseBookRepository, FieldRepositoryInterface $fieldRepository , GetService $get){
        $this->courseBookRepository = $courseBookRepository;
        $this->fieldRepository = $fieldRepository;
        $this->get = $get;
    }


    public function getField($id){
        return $this->get->handle(FieldResource::class , $this->fieldRepository , 'getById' ,
            [$id] , ['*'] , ['categories']);
    }
}
