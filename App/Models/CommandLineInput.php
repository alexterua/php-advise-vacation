<?php

namespace App\Models;

use InvalidArgumentException;

class CommandLineInput
{
    /** @var int */
    private int $participants;

    /** @var string */
    private string $type;

    /** @var string */
    private string $senderType;

    /**
     * @param int $argc
     * @param array $argv
     * @throws InvalidArgumentException
     */
    public function __construct(int $argc, array $argv)
    {
        if ($argc !== 4) {
            throw new InvalidArgumentException("Use command: php index.php [participants] [type] [sender]");
        }

        $this->participants = (int)$argv[1];
        $this->type = $argv[2];
        $this->senderType = $argv[3];
    }

    /** @return int */
    public function getParticipants(): int
    {
        return $this->participants;
    }

    /** @return string */
    public function getType(): string
    {
        return $this->type;
    }

    /** @return string */
    public function getSenderType(): string
    {
        return $this->senderType;
    }
}