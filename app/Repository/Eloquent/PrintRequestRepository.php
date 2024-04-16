<?php

namespace App\Repository\Eloquent;

use App\Models\Answer;
use App\Models\PrintRequest;
use App\Repository\AnswerRepositoryInterface;
use App\Repository\PrintRequestRepositoryInterface;
use App\Repository\QuestionRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class PrintRequestRepository extends Repository implements PrintRequestRepositoryInterface
{
    protected Model $model;

    public function __construct(PrintRequest $model){
        parent::__construct($model);
    }


    public function getBooksRequests()
    {
        $requests =  $this->model::query()->where('type' , 'BOOK')->orderBy('id' , 'DESC');

        return $this->filterRequests($requests);
    }

    public function getCertificatesRequests()
    {
        $requests =  $this->model::query()->where('type' , 'CERTIFICATE')->orderBy('id' , 'DESC');

        return $this->filterRequests($requests);
    }

    public function getPendingCount(){
        return $this->model::query()->where('status' , 'ORDERED')->count();
    }

    private function filterRequests($requests){

        if (request('course') && request('course') != "ALL"){
            $requests->where('course_id' , request('course'));
        }
        if (request()->has('search') && request('search') != null){
            $requests->whereHas('user' , function ($query) {
                $query->where('name' , 'LIKE' , '%' . \request('search') . '%')->orWhere('email' , 'LIKE' , '%' .\request('search') . '%')
                    ->orWhere('phone' , 'LIKE' , '%' . \request('search') . '%');
            });
        }
        if (\request()->has('from_date') && \request('from_date') != ""){
            $requests->whereDate('created_at' , '>=' , \request('from_date'));
        }
        if (\request()->has('to_date') && \request('to_date') != ""){
            $requests->whereDate('created_at' , '<=' , \request('to_date'));
        }

        return $requests;
    }
}
