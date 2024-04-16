<?php

namespace App\Http\Services\Mutual;

use App\Http\Traits\Responser;
use App\Repository\RepositoryInterface;
use Exception;

class GetService
{
    use Responser;

    public function handle($resource, RepositoryInterface $repository, $method = 'getAll', $parameters = [], $is_instance = false, $message = 'Success')
    {
        try {
            $executable = $repository->$method(...$parameters);
            $records = $is_instance ? new $resource($executable) : $resource::collection($executable);
            return $this->responseSuccess(message: $message, data: $records);
        } catch (Exception $e) {
//            return $e->getMessage();
            return $this->responseFail(status: 404, message: __('messages.No data found'));
        }
    }
}
