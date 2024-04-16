<?php

namespace App\Http\Services\Dashboard\ContactUs;
use App\Http\Mail\SendReply;
use App\Models\Contact;
use App\Repository\ContactRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Dashboard\ContactUs\ContactUsRequest;
use Mail;

class ContactUsService
{
    private ContactRepositoryInterface $contactusRepository;

    public function __construct(ContactRepositoryInterface $contactusRepository)
    {
        $this->contactusRepository = $contactusRepository;
    }

    public function reply(ContactUsRequest $request,$id)
    {
        $contact = Contact::find($id);
        $contact->update(['is_readed' => 1]);
        Mail::to($contact->email)->send(new SendReply($request->content));
    }


}
