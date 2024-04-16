<?php

namespace App\Repository\Eloquent;

use App\Models\Notification;
use App\Repository\NotificationRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class NotificationRepository extends Repository implements NotificationRepositoryInterface
{
    protected Model $model;

    public function __construct(Notification $model)
    {
        parent::__construct($model);
    }

    public function count()
    {
        return $this->model::query()->count();
    }

    public function getNotificationForUser($id)
    {
        return $this->model::where('user_id',$id)->orderBy('created_at', 'desc')->get();
    }

}
