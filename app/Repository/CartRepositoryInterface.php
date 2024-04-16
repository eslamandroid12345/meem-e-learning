<?php

namespace App\Repository;

interface CartRepositoryInterface extends RepositoryInterface
{

    public function provide();

    public function getLeftCarts();

    public function isPayable($cart_id);

}
