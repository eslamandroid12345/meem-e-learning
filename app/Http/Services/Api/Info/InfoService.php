<?php

namespace App\Http\Services\Api\Info;

use App\Http\Resources\Info\InfoResource;
use App\Http\Services\Mutual\GetService;
use App\Repository\InfoRepositoryInterface;

class InfoService
{
    private GetService $get;
    private InfoRepositoryInterface $infoRepository;

    public function __construct(
        GetService $get,
        InfoRepositoryInterface $infoRepository,
    )
    {
        $this->get = $get;
        $this->infoRepository = $infoRepository;
    }

    public function get($info)
    {
        return $this->get->handle(InfoResource::class, $this->infoRepository, 'first', ['key', $info], true);
    }

}
