<?php

namespace App\Http\Services\Api\Profile;

use App\Http\Requests\Api\Profile\ProfileDetailsRequest;
use App\Http\Requests\Api\Profile\ProfilePasswordRequest;
use App\Http\Resources\Course\CourseBookResource;
use App\Http\Resources\Course\CourseResource;
use App\Http\Resources\Payment\PaymentHistoryResource;
use App\Http\Resources\User\UserResource;
use App\Http\Services\Mutual\FileManagerService;
use App\Http\Services\Mutual\GetService;
use App\Http\Traits\Responser;
use App\Repository\CourseBookRepositoryInterface;
use App\Repository\CourseRepositoryInterface;
use App\Repository\PaymentItemRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Exception;

abstract class ProfileService
{
    use Responser;

    protected UserRepositoryInterface $userRepository;
    protected FileManagerService $fileManager;
    protected CourseRepositoryInterface $courseRepository;
    protected CourseBookRepositoryInterface $courseBookRepository;
    protected PaymentItemRepositoryInterface $paymentItemRepository;
    protected GetService $get;

    public function __construct(
        UserRepositoryInterface $userRepository,
        FileManagerService $fileManagerService,
        CourseRepositoryInterface $courseRepository,
        CourseBookRepositoryInterface $courseBookRepository,
        PaymentItemRepositoryInterface $paymentItemRepository,
        GetService $getService,
    )
    {
        $this->userRepository = $userRepository;
        $this->fileManager = $fileManagerService;
        $this->courseRepository = $courseRepository;
        $this->courseBookRepository = $courseBookRepository;
        $this->paymentItemRepository = $paymentItemRepository;
        $this->get = $getService;
    }

    public function update(ProfileDetailsRequest|ProfilePasswordRequest $request) {
        $data = $request->validated();
        try {
            $user = auth('api')->user();
            if ($request->image !== null) {
                $data['image'] = $this->fileManager->handle('image', 'profiles/students/images', $user->image);
            }
            $this->userRepository->update(auth('api')->id(), $data);
            return $this->get->handle(
                resource: UserResource::class,
                repository: $this->userRepository,
                method: 'getById',
                parameters: [$request->user()->id],
                is_instance: true,
                message: __('messages.Your profile updated successfully'),
            );
        } catch (Exception $e) {
            return $this->responseFail(message: __('messages.Something went wrong'));
        }
    }

    public function details() {
        return $this->get->handle(UserResource::class, $this->userRepository, method: 'getById', parameters: [auth('api')->id()], is_instance: true);
    }

    public function books(){
        return $this->get->handle(CourseBookResource::class, $this->courseBookRepository, method: 'getProfileBooks',
            is_instance: false);
    }

    public function payments() {
        return $this->get->handle(PaymentHistoryResource::class, $this->paymentItemRepository, 'get', ['user_id', auth('api')->id()]);
    }

}
