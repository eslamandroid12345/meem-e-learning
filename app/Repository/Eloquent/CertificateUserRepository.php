<?php

namespace App\Repository\Eloquent;

use App\Models\CertificateUser;
use App\Repository\CertificateUserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CertificateUserRepository extends Repository implements CertificateUserRepositoryInterface
{
    protected Model $model;

    public function __construct(CertificateUser $model)
    {
        parent::__construct($model);
    }

    public function getUserCertificates($user_id){
        return $this->model::query()->where('user_id' , $user_id)->whereNotNull('print_request_id')->orderByDesc('id')->get();
    }

    public function provide($course_id) {
        return $this->model::query()->updateOrCreate(
            [
                'course_id' => $course_id,
                'user_id' => auth('api')->id(),
                'is_active' => false,
            ],
            [
                'print_request_id' => null,
            ]
        );
    }

    public function checkCourseCertificateUserAccepted($course_id){
        return $this->model::query()
            ->where('user_id',auth('api')->id())
            ->where('course_id',$course_id)
            ->where('is_active',1)
            ->count();
    }

    public function checkCourseCertificateUserPending($course_id){
        return $this->model::query()
            ->where('user_id',auth('api')->id())
            ->where('course_id',$course_id)
            ->where('is_active',0)
            ->count();
    }
}
