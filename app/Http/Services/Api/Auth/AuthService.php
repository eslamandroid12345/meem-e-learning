<?php

namespace App\Http\Services\Api\Auth;

use App\Models\DeviceToken;
use Mail;
use App\Http\Mail\ResetMail;
use App\Http\Resources\User\UserResource;
use App\Http\Traits\Responser;
use App\Repository\UserRepositoryInterface;
use App\Repository\ResetPasswordRepositoryInterface;
use App\Http\Requests\Api\Auth\UserResetRequest;
use App\Http\Requests\Api\Auth\UserConfirmRequest;
use App\Http\Requests\Api\Auth\UserChangePasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

abstract class AuthService{
    
    use Responser;

    protected UserRepositoryInterface $userRepository;
    protected ResetPasswordRepositoryInterface $resetRepository;

    public function __construct(UserRepositoryInterface $userRepository , ResetPasswordRepositoryInterface $resetRepository)
    {
        $this->userRepository = $userRepository;
        $this->resetRepository = $resetRepository;
    }


    public function login($request)
    {
        $credentials = $request->only('phone', 'password');
        $token = Auth::guard('api')->attempt($credentials);
        if($token)
        {
            if (\auth('api')->user()->is_active == 0)
                return $this->responseFail(status: 401, message: __('messages.student_not_active'));
                if(!is_null($request->fcm_token))
                {
                    DeviceToken::updateOrCreate(
                                                    ['token' => $request->fcm_token],
                                                    ['user_id' => auth('api')->id()],
                                                );
                }
            return $this->responseSuccess(message: __('messages.Successfully authenticated'), data: new UserResource(auth('api')->user()));
        }
        return $this->responseFail(status: 401, message: __('messages.wrong credentials'));
    }

    public function register($request)
    {
        $data = $request->validated();
        $data['is_active'] = 1;
        DB::beginTransaction();
        try
        {
            $user = $this->userRepository->create($data);
            $this->generateCommunicationCode($user);
            DB::commit();
            return $this->login($request);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return $this->responseFail(status: 401, message: __('messages.Something went wrong'));
        }
    }

    public function logout()
    {
        Auth::guard('api')->logout();
        return $this->responseSuccess(message: __('messages.Successfully loggedOut'));
    }

    public function refresh()
    {
        \auth('api')->refresh();
        return $this->responseSuccess(message: __('messages.Successfully authenticated'), data: new UserResource(auth('api')->user()));

    }

    public function updateProfile($request)
    {
        $user = \auth()->guard('api')->user();
        DB::beginTransaction();
        $data = $request->validated();
        try {
            $this->userRepository->update($user['id'] , $data);
            DB::commit();
            return $this->responseSuccess(200 , __('messages.Student updated successfully')  , new UserResource($user) );
        }catch (\Exception $e){
            DB::rollBack();
            return $this->responseFail(status: 401, message: __('messages.Something went wrong'));
        }
    }

    public function updatePassword($request)
    {
        $user = \auth('api')->user();
        DB::beginTransaction();
        try {
            $this->userRepository->update($user['id'] , [
                'password' => $request['new_password']
            ]);
            DB::commit();
            return $this->responseSuccess(200 , __('messages.Student updated successfully')  , new UserResource($user) );
        }catch (\Exception $e){
            DB::rollBack();
            return $this->responseFail(status: 401, message: __('messages.Something went wrong'));
        }
    }

    public function generateCommunicationCode($user)
    {
        $code = random_int(100 , 900) . $user['id'] . random_int(100 , 900);
        $user->communication_code = $code;
        $user->save();
    }

    public function delete()
    {
        $this->userRepository->delete(auth('api')->id());
        return $this->responseSuccess(message: __('messages.deleted successfully'));
    }

    public function reset(UserResetRequest $request)
    {
        try
        {
            $user = $this->userRepository->getByEmail($request->email);
            if($user)
            {
                $randomNumber = random_int(1000, 9999);
                $details = [
                                'title' => 'Reset',
                                'body' =>  $randomNumber,
                            ];

                Mail::to($request->email)->send(new ResetMail($details));
                $this->resetRepository->deleteByUserId($user->id);
                $this->resetRepository->create([
                                                    'user_id' => $user->id,
                                                    'reset' => $randomNumber,
                                                ]);
                return $this->responseSuccess(message: __('messages.send_code_successfully'));
            }
            else
            {
                return $this->responseFail(status: 401, message: __('messages.Email_Not_found'));
            }
        }
        catch (\Exception $e)
        {
            return response()->json($e->getMessage(), 401);
        }
    }

    public function resetUserconfirm(UserConfirmRequest $request)
    {
        try
        {
            $user = $this->userRepository->getByEmail($request->email);
            $reset = $this->resetRepository->getByConfirm($request->confirm,$user->id);
            if($reset)
            {
                return $this->responseSuccess(message: __('messages.code_Is_Confirm'));
            }
            else
            {
                return $this->responseFail(status: 404, message: __('messages.code_Not_Confirm'));
            }
        }
        catch (\Exception  $e)
        {
            return response()->json($e->getMessage(), 401);
        }
    }

    public function changePassword(UserChangePasswordRequest $request)
    {
        try
        {
            $user = $this->userRepository->getByEmail($request->email);
            if($user)
            {
                if($request->newpassword == $request->confirmpassword)
                {
                    $user->update(['password' => $request->newpassword]);
                    $this->resetRepository->deleteByUserId($user->id);
                    return $this->responseSuccess(message: __('messages.password_Is_Changed'));
                }
                else
                {
                    return $this->responseFail(status: 404, message: __('messages.Passowrd_Not_Confirm'));
                }
            }
            return $this->responseFail(status: 404, message: __('messages.User_Not_Found'));
        }
        catch (\Exception  $e)
        {
            return response()->json($e->getMessage(), 401);
        }
    }

}
