<?php

namespace App\Http\Traits;

use App\Models\Notification;
use App\Repository\NotificationRepositoryInterface;
use App\Repository\UserRepositoryInterface;

trait NotificationManager
{
    private static string $serverApiKey = 'AAAAzeaxqxE:APA91bFuQzFrYNOeiijnH2nPfwFYUOGA6bMrrwN-d17wZRO-vH0qeLPw0sf6JNtZw9yc8AqkzBb5NNeB793iYeRw_ztSx3nlcvqz1pBTD6UONmTjE6CZfbCdmWbqhJ5i2ZtHb6IYOQ4R';

    private UserRepositoryInterface $userRepository;
    protected NotificationRepositoryInterface $notificationRepository;

    public function __construct(UserRepositoryInterface $userRepository,NotificationRepositoryInterface $notificationRepository)
    {
        $this->userRepository = $userRepository;
        $this->notificationRepository = $notificationRepository;
    }


    private function getDeviceTokens($target)
    {
        return $this->userRepository->getDeviceTokens($target);
    }

    private function notificationScheme(array $deviceTokens, string $title, $content , string $type=null, string $typecontent=null,$subscribe = false)
    {
        return json_encode([
        'registration_ids'  => $deviceTokens,
        'notification'      => [
        'title' => $title,
        'body' => $content,
        ],
        'data'  => [
        'type' => $type,
        'content' => $typecontent,
        'subscribe' => $subscribe,
            ],
        ]);
    }

    private function preparePush($deviceTokens,$title,$content,$usersIds=[], string $type=null, string $typecontent=null,$subscribe = false)
    {

        if(!empty($usersIds))
        {
            foreach($usersIds as $index => $userId)
            {
                Notification::create([
                'user_id'       => $userId,
                'title'         => $title,
                'body'          => $content,
                'type'          => $type,
                'content'       => $typecontent,
                'is_subscribe'     => $subscribe,
            ]);

            }
        }

        // $users = $this->getDeviceTokens($request->to);

        // $usersIds = array_keys($users);
        // $usersDeviceTokens = array_values($users);
        // $notification->users()->attach($usersIds);
        return $this->notificationScheme(deviceTokens: $deviceTokens, title: $title, content: $content,type: $type, typecontent: $typecontent,subscribe: $subscribe);
    }


}
