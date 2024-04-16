<?php

namespace App\Repository;

interface PaymentRepositoryInterface extends RepositoryInterface
{

    public function confirm($paymentId);

    public function getOrderedPayments();

    public function getBankTransfers();

    public function getPaymentsCount();

    public function notActivatedCount();

}
