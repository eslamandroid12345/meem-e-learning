<?php

namespace App\Repository;

use Illuminate\Http\Request;

interface CourseBankQuestionRepositoryInterface extends RepositoryInterface
{
    public function getBankQuestionsByCourse(Request $request);

}
