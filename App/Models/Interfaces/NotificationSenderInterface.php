<?php

namespace App\Models\Interfaces;

interface NotificationSenderInterface
{
    /**
     * @param string $message
     * @return void
     */
    public function send(string $message): void;
}