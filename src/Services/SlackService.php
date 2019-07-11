<?php

namespace App\Services;

use App\Helpers\LoggerTrait;
use Nexy\Slack\Client;

class SlackService
{
    use LoggerTrait;

    /**
     * @var Client
     */
    private $slack;

    public function __construct(Client $slack)
    {
        $this->slack = $slack;
    }

    /**
     * @param string $from
     * @param string $message
     *
     * @return SlackService
     *
     * @throws \Http\Client\Exception
     */
    public function sendMessage(string $from, string $message)
    {
        $this->logInfo($message);

        $slackMessage = $this->slack->createMessage()
                    ->from($from)
                    ->withIcon(':ghost:')
                    ->setText($message);

        $this->slack->sendMessage($slackMessage);

        return $this;
    }
}
