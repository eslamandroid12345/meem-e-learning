<?php

namespace App\Repository;

interface CouponRepositoryInterface extends RepositoryInterface
{

    public function isValid($coupon);

    public function stillUsable($coupon);
    public function isUsedBefore($coupon);
    public function isMobilOnly($coupon);


}
