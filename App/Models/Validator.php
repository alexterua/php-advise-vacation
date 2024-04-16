<?php

namespace App\Models;

use Exception;

class Validator
{
    /** @var int */
    const MIN_COUNT_PARTICIPANTS = 0;

    /** @var int */
    const MAX_COUNT_PARTICIPANTS = 8;

    /** @var array */
    const TYPES_OF_ACTIVITY = ["education", "recreational", "social", "diy", "charity", "cooking", "relaxation", "music", "busywork"];

    /** @var array */
    const METHODS_FOR_SENDING_NOTIFICATION = ["file", "console"];

    /**
     * @param int $participants
     * @param string $type
     * @param string $senderType
     * @return void
     * @throws Exception
     */
    public function validate(int $participants, string $type, string $senderType): void
    {
        if ($participants < self::MIN_COUNT_PARTICIPANTS || $participants > self::MAX_COUNT_PARTICIPANTS) {
            throw new Exception("The number of participants must be from 0 to 8!");
        }

        if (!in_array($type, self::TYPES_OF_ACTIVITY)) {
            throw new Exception("Activity type '$type' not found in [" . implode(", ", self::TYPES_OF_ACTIVITY) . "]!");
        }

        if (!in_array($senderType, self::METHODS_FOR_SENDING_NOTIFICATION)) {
            throw new Exception("Method for sending notification '$senderType' not found in [" . implode(", ", self::METHODS_FOR_SENDING_NOTIFICATION) . "]!");
        }
    }
}