<?php

namespace App\Repository;

interface CertificateUserRepositoryInterface extends RepositoryInterface
{
    public function getUserCertificates($user_id);

    public function provide($course_id);
}
