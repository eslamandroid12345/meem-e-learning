<?php

namespace App\Repository;

interface CertificateUserRepositoryInterface extends RepositoryInterface
{
    public function getUserCertificates($user_id);

    public function provide($course_id);

    public function checkCourseCertificateUserAccepted($course_id);
    public function checkCourseCertificateUserPending($course_id);
}
