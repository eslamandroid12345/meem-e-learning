<?php

namespace App\Views\Composers;

use App\Repository\ContactRepositoryInterface;
use Illuminate\View\View;

class ContactsComposer {

    private ContactRepositoryInterface $contactRepository;

    public function __construct(
        ContactRepositoryInterface $contactRepository,
    ) {
        $this->contactRepository = $contactRepository;
    }

    public function compose(View $view) {
        $contactsCount = $this->contactRepository->count();
        $view->with('contactsCount', $contactsCount);
   }
}
