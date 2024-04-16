<?php

namespace App\Repository;

interface ResetPasswordRepositoryInterface extends RepositoryInterface
{
    public function getCount();

    public function deleteByUserId($user_id);

    public function getByConfirm($confirm,$user_id);

}
