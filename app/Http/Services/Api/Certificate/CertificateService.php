<?php

namespace App\Http\Services\Api\Certificate;

use App\Http\Requests\Api\Course\CertificateRequest;
use App\Http\Resources\Certificate\CertificateResource;
use App\Http\Resources\Certificate\RequestableCertificateResource;
use App\Http\Resources\Course\CourseCertificateResource;
use App\Http\Services\Mutual\GetService;
use App\Http\Traits\Responser;
use App\Repository\CertificateUserRepositoryInterface;
use App\Repository\CourseRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

abstract class CertificateService
{
    use Responser;

    protected GetService $get;
    protected CertificateUserRepositoryInterface $certificateUserRepository;
    protected CourseRepositoryInterface $courseRepository;

    public function __construct(
        GetService $getService,
        CertificateUserRepositoryInterface $certificateUserRepository,
        CourseRepositoryInterface $courseRepository,
    )
    {
        $this->get = $getService;
        $this->certificateUserRepository = $certificateUserRepository;
        $this->courseRepository = $courseRepository;
    }

    public function request(CertificateRequest $request) {
        $data = $request->validated();
        $course = $this->courseRepository->getById($data['course_id']);
        if (Gate::allows('request-certificate', $course)) {
            DB::beginTransaction();
            try {
                $certificate = $this->certificateUserRepository->provide($data['course_id']);
                DB::commit();
                return $this->responseSuccess(data: [
                    'certificate_user_id' => $certificate->id,
                ]);
            } catch (Exception $e) {
//            return $e->getMessage();
                return $this->responseFail(message: __('messages.Something went wrong'));
            }
        } else {
            return $this->responseFail(message: __('messages.You are not authorized to request this certificate'));
        }

    }

    public function getRequested() {
        return $this->get->handle(CertificateResource::class, $this->certificateUserRepository, 'getUserCertificates' , [auth()->id()]);
    }

    public function getRequestable() {
        return $this->get->handle(RequestableCertificateResource::class, $this->courseRepository, 'getRequestableCertificates');
    }

}
