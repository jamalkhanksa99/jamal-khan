<?php
/*
 * File name: NewBroadcastMessage.php

 * Author: DAS360
 * Copyright (c) 2022
 */

namespace App\Notifications;

use App\Models\NotificationMessage;
use Benwilkins\FCM\FcmMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BroadcastMessage extends Notification
{
    use Queueable;

    /** @var string */
    private $title;

    /** @var string */
    private $content;

    /** @var string */
    private $messageId;


    /**
     * Create a new notification instance.
     *
     * @param NotificationMessage $notificationMessage
     */
    public function __construct(NotificationMessage $notificationMessage)
    {
        $this->title = $notificationMessage->title;
        $this->content = $notificationMessage->content;
        $this->messageId = $notificationMessage->id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'fcm'];
    }

    /**
     * Get the fcm representation of the notification.
     *
     * @param mixed $notifiable
     * @return FcmMessage
     */

    public function toFcm($notifiable): FcmMessage
    {
        $message = new FcmMessage();
        $notification = [
            'title' => $this->title,
            'body' => $this->content,
            'click_action' => "FLUTTER_NOTIFICATION_CLICK",
            'id' => 'App\\Notifications\\BroadcastMessage',
            'status' => 'done',
        ];
        $data = $notification;
        $data['messageId'] = $this->messageId;
        $message->content($notification)->data($data)->priority(FcmMessage::PRIORITY_HIGH);
        return $message;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable): array
    {
        return [
            'title' => $this->title,
            'body' => $this->content,
            'message_id' => $this->messageId,
        ];
    }
}
