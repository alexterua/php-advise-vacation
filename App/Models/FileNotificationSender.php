<?php

namespace App\Models;

use Exception;
use App\Models\Interfaces\NotificationSenderInterface;

class FileNotificationSender implements NotificationSenderInterface
{
    /**
     * @param string $message
     * @return void
     * @throws Exception
     */
    public function send(string $message): void {
        if (file_put_contents('activity.txt', $message) === FALSE) {
            throw new Exception("Error: Unable to write to file.");
        }
    }
}