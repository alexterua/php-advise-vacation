<?php

namespace App\Models;

use App\Models\Interfaces\NotificationSenderInterface;

class ConsoleNotificationSender implements NotificationSenderInterface
{
    /**
     * @param string $message
     * @return void
     */
    public function send(string $message): void {
        echo $message;
    }
}