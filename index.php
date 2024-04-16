<?php
// Initial
const COUNT_OF_PARAMETERS = 3;
const MIN_COUNT_PARTICIPANTS = 0;
const MAX_COUNT_PARTICIPANTS = 8;

const TYPES_OF_ACTIVITY = ["education", "recreational", "social", "diy", "charity", "cooking", "relaxation", "music", "busywork"];

const METHODS_FOR_SENDING_NOTIFICATION = ["file", "console"];
// Initial End

if ($argc !== (COUNT_OF_PARAMETERS + 1)) {
    echo "Use command: php index.php [participants] [type] [sender]" . PHP_EOL;
    exit(1);
}

$participants = (int)$argv[1];
$type = $argv[2];
$sender = $argv[3];

// Validation
if ($participants < MIN_COUNT_PARTICIPANTS || $participants > MAX_COUNT_PARTICIPANTS) {
    echo "The number of participants must be from 0 to 8!" . PHP_EOL;
    exit(1);
}

if (!in_array($type, TYPES_OF_ACTIVITY)) {
    echo "Activity type '$type' not found in [" . implode(", ", TYPES_OF_ACTIVITY) . "]!" . PHP_EOL;
    exit(1);
}

if (!in_array($sender, METHODS_FOR_SENDING_NOTIFICATION)) {
    echo "Method for sending notification '$sender' not found in [" . implode(", ", METHODS_FOR_SENDING_NOTIFICATION) . "]!" . PHP_EOL;
    exit(1);
}
// Validation End

$url = "http://www.boredapi.com/api/activity?participants=$participants&type=$type";

$context = stream_context_create(['http' => ['ignore_errors' => true]]);
$result = file_get_contents($url, false, $context);

if ($result === FALSE) {
    echo "Error: Unable to fetch data from the API." . PHP_EOL;
    exit(1);
}

$data = json_decode($result, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo "Error: Unable to decode JSON data." . PHP_EOL;
    exit(1);
}

$message = $data['activity'] ?? 'No activity found';

if ($sender === 'file') {
    if (file_put_contents('activity.txt', $message) === FALSE) {
        echo "Error: Unable to write to file." . PHP_EOL;
        exit(1);
    }
} elseif ($sender === 'console') {
    echo $message;
} else {
    echo "Invalid sender. Use " . implode(" or ", METHODS_FOR_SENDING_NOTIFICATION) . PHP_EOL;
}
