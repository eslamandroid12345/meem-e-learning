<?php

namespace App\Http\Services\Api\Book;


use App\Http\Resources\BookStore\BookCollection;
use App\Http\Resources\BookStore\BookDetailsResource;
use App\Http\Services\Mutual\GetService;
use App\Repository\CourseBookRepositoryInterface;

abstract class BookService
{
    protected GetService $get;
    protected CourseBookRepositoryInterface $courseBookRepository;

    public function __construct(CourseBookRepositoryInterface $courseBookRepository, GetService $get){
        $this->courseBookRepository = $courseBookRepository;
        $this->get = $get;
    }


    public function filter(){
        return $this->get->handle(BookCollection::class , $this->courseBookRepository , 'filterStoreBooks' ,
            [9  , ['id' , 'course_id' , 'name_ar' , 'name_en' , 'description_ar' , 'description_en' , 'image' , 'price'] ,['course'] , 'DESC'] ,
            true);
    }

    public function show($id){
        return $this->get->handle(BookDetailsResource::class , $this->courseBookRepository , 'getById',
            [$id ,['*'] ,  ['course:name_ar,name_en,description_ar,description_en']] ,
            true);
    }
}
