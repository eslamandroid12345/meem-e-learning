<?php

namespace App\Http\Services\Api\Contact;


use App\Http\Requests\Api\Contacts\SendContactRequest;

use App\Http\Traits\Responser;
use App\Repository\ContactRepositoryInterface;


abstract class ContactService
{
    use Responser;
    protected ContactRepositoryInterface $contactRepository;

    public function __construct(ContactRepositoryInterface $contactRepository){
        $this->contactRepository = $contactRepository;
    }

   public function sendContact(SendContactRequest $request){
       $this->contactRepository->create($request->validated());
       return $this->responseSuccess(200 , __('messages.Your_message_has_been_sent'));
   }
}
