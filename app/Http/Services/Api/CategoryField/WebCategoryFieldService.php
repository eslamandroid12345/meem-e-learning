<?php

namespace App\Http\Services\Api\CategoryField;

use App\Http\Resources\Field\Web\FieldResource;

class WebCategoryFieldService extends CategoryFieldService
{

    public function index(){
        return $this->get->handle(FieldResource::class , $this->fieldRepository , 'getActive' ,
            []);
    }

    public function getNavbarFields() {
        return $this->get->handle(FieldResource::class, $this->fieldRepository, 'getNavbarFields');
    }

}
