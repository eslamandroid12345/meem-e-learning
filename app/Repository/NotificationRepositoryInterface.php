<?php

namespace App\Repository;

interface NotificationRepositoryInterface extends RepositoryInterface
{

    public function count();

    public function getNotificationForUser($id);

}
