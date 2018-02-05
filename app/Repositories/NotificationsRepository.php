<?php
namespace App\Repositories;


class NotificationsRepository
{
    public function addComponentType($notifications)
    {
        return collect($notifications)->map(function ($notification) {
            $notification->component_type = snake_case(class_basename($notification->type));
            return $notification;
        });
    }

    public function addCreatedTime($notifications)
    {
        return collect($notifications)->map(function ($notification) {
            $notification->created_time = $notification->created_at->diffForHumans();
            return $notification;
        });
    }
}
