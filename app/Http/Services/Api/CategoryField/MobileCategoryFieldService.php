<?php

namespace App\Http\Services\Api\CategoryField;

use App\Http\Resources\Field\Mobile\FieldResource;

class MobileCategoryFieldService extends CategoryFieldService
{

    public function index(){
        return $this->get->handle(FieldResource::class , $this->fieldRepository , 'getActive' ,
            []);
    }

}
