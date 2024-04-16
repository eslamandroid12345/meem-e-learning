<?php

namespace App\Http\Services\Api\Manager;

use App\Http\Resources\Course\CourseTeacherResource;
use App\Http\Services\Mutual\GetService;
use App\Repository\ManagerRepositoryInterface;

abstract class ManagerService
{
    protected ManagerRepositoryInterface $managerRepository;
    protected GetService $get;

    public function __construct(ManagerRepositoryInterface $managerRepository , GetService $get){
        $this->managerRepository = $managerRepository;
        $this->get = $get;
    }


    public function show($id){
        return $this->get->handle(CourseTeacherResource::class , $this->managerRepository , 'getById' ,
            [$id] , true);
    }
}
