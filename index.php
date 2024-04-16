<?php

use App\Models\ActivityNotifier;
use App\Models\BoredApiActivity;
use App\Models\CommandLineInput;
use App\Models\ConsoleNotificationSender;
use App\Models\FileNotificationSender;
use App\Models\Validator;

require_once __DIR__ . '/autoload.php';

spl_autoload_register('my_autoloader');

try {
    $input = new CommandLineInput($argc, $argv);

    $participants = $input->getParticipants();
    $type = $input->getType();
    $senderType = $input->getSenderType();

    $validator = new Validator();
    $validator->validate($participants, $type, $senderType);

    $activity = new BoredApiActivity($participants, $type);

    $sender = $senderType === 'file' ? new FileNotificationSender() : new ConsoleNotificationSender();

    $notifier = new ActivityNotifier($activity, $sender);
    $notifier->notify();

} catch (Exception $e) {
    echo $e->getMessage();
}
