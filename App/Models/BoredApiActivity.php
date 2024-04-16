<?php

namespace App\Models;

use Exception;
use App\Models\Interfaces\ActivityInterface;

class BoredApiActivity implements ActivityInterface
{
    /** @var string */
    const API_URL = "http://www.boredapi.com/api/activity";

    /** @var int */
    private int $participants;

    /** @var string */
    private string $type;

    /**
     * @param int $participants
     * @param string $type
     */
    public function __construct(int $participants, string $type) {
        $this->participants = $participants;
        $this->type = $type;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getActivity(): string {
        $url = self::API_URL . "?participants={$this->participants}&type={$this->type}";
        $context = stream_context_create(['http' => ['ignore_errors' => true]]);
        $result = file_get_contents($url, false, $context);

        if ($result === FALSE) {
            throw new Exception("Error: Unable to fetch data from the API.");
        }

        $data = json_decode($result, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("Error: Unable to decode JSON data.");
        }

        return $data['activity'] ?? 'No activity found';
    }
}