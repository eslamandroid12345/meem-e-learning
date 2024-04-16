<?php

namespace App\Http\Services\Api\Structure;

use App\Http\Services\Mutual\GetService;
use App\Http\Traits\Responser;
use App\Repository\StructureRepositoryInterface;

abstract class StructureService
{
    use Responser;

    protected StructureRepositoryInterface $structureRepository;
    protected GetService $get;

    public function __construct(
        StructureRepositoryInterface $structureRepository,
        GetService $getService,
    )
    {
        $this->structureRepository = $structureRepository;
        $this->get = $getService;
    }

    public function get($key, $resource, array $with = [null => [null]]) {
        $structure = $this->structureRepository->structure($key);
        if ($structure?->exists()) {
            $structure = safeArray(json_decode($structure->content)->{app()->getLocale()});
            $withSections = [];
            foreach ($with as $key => $sections) {
                if (is_array($sections)) {
                    foreach ($sections as $section) {
                        $withSections[$key][$section] = $this->getSection($key, $section);
                    }
                }
            }
            return $this->responseSuccess(data: new $resource($structure, $withSections));
        } else {
            return $this->responseFail();
        }
    }

    private function getSection($key, $section) {
        $structure = $this->structureRepository->structure($key);
        if ($structure?->exists() && $section !== null) {
            return safeArray(json_decode($structure->content)->{app()->getLocale()}->$section) ?? null;
        } else {
            return null;
        }
    }
}
