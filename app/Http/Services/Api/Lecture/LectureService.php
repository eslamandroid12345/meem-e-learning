<?php

namespace App\Http\Services\Api\Lecture;

use App\Http\Resources\Course\Mobile\LectureResource;
use App\Http\Resources\Lecture\PinResource;
use App\Http\Services\Mutual\GetService;
use App\Http\Traits\Responser;
use App\Repository\LecturePinRepositoryInterface;
use App\Repository\LectureRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

abstract class LectureService
{
    use Responser;
    protected LectureRepositoryInterface $lectureRepository;
    protected LecturePinRepositoryInterface  $lecturePinRepository;

    protected GetService $get;

    public function __construct(LectureRepositoryInterface $lectureRepository , LecturePinRepositoryInterface  $lecturePinRepository , GetService $get){
        $this->lectureRepository = $lectureRepository;
        $this->lecturePinRepository = $lecturePinRepository;
        $this->get = $get;
    }


    public function showLecture($id){
        return $this->get->handle(LectureResource::class , $this->lectureRepository , 'getById' ,
            [$id] ,
            true);
    }

    public function lecturePins($id){
        return $this->get->handle(PinResource::class , $this->lecturePinRepository , 'getByLectureId' ,
            [$id] ,
            false);
    }

    public function completeWatch($lecture_id){
        $lecture = $this->lectureRepository->getById($lecture_id);
        DB::beginTransaction();
        try {
            if (Gate::allows('cant_attend_lecture' , $lecture))
                return $this->responseFail(422 , __('messages.You are not authorized to watch this lecture'));
            auth('api')->user()->watchedLectures()->create([
               'lecture_id' => $lecture_id
            ]);
            DB::commit();
            return $this->responseSuccess(200 , __('messages.lecture watched'));
        }catch (\Exception $e){
            DB::rollBack();
            return $this->responseFail(422 , __('messages.Something went wrong'));
        }
    }



}
