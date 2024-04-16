<?php

namespace App\Repository;

interface PrintRequestRepositoryInterface extends RepositoryInterface
{

    public function getBooksRequests();
    public function getCertificatesRequests();
    public function getPendingCount();

}
