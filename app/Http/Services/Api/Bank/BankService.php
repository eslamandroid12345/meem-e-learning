<?php

namespace App\Http\Services\Api\Bank;


use App\Http\Requests\Api\Contacts\SendContactRequest;

use App\Http\Resources\Bank\BankResource;
use App\Http\Services\Mutual\GetService;
use App\Http\Traits\Responser;
use App\Repository\BankRepositoryInterface;


abstract class BankService
{
    use Responser;
    protected BankRepositoryInterface $bankRepository;
    protected GetService $get;

    public function __construct(BankRepositoryInterface $bankRepository , GetService $get){
        $this->bankRepository = $bankRepository;
        $this->get = $get;
    }

    public function getBanks(){
        return $this->get->handle(BankResource::class , $this->bankRepository, is_instance: false);
    }

}
