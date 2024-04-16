<?php

namespace App\Models;

use App\Models\Interfaces\ActivityInterface;
use App\Models\Interfaces\NotificationSenderInterface;

class ActivityNotifier
{
    /** @var ActivityInterface */
    private ActivityInterface $activity;

    /** @var NotificationSenderInterface */
    private NotificationSenderInterface $sender;

    /**
     * @param ActivityInterface $activity
     * @param NotificationSenderInterface $sender
     */
    public function __construct(ActivityInterface $activity, NotificationSenderInterface $sender) {
        $this->activity = $activity;
        $this->sender = $sender;
    }

    /** @return void */
    public function notify(): void {
        $message = $this->activity->getActivity();
        $this->sender->send($message);
    }
}