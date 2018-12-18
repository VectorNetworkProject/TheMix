<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\task;

use pocketmine\scheduler\Task;
use VectorNetworkProject\TheMix\game\event\game\PhaseTimeUpdateEvent;

class PhaseTask extends Task
{
    /** @var int $time */
    private $time;

    /**
     * PhaseTask constructor.
     *
     * @param int $time
     */
    public function __construct(int $time = 600)
    {
        $this->time = $time;
    }

    /**
     * @param int $currentTick
     *
     * @throws \ReflectionException
     */
    public function onRun(int $currentTick)
    {
        $event = new PhaseTimeUpdateEvent($this->getTime() - 1);
        $event->call();
        if (!$event->isCancelled()) {
            $this->setTime($this->getTime() - 1);
        }
    }

    /**
     * @return int
     */
    public function getTime(): int
    {
        return $this->time;
    }

    /**
     * @param int $time
     */
    public function setTime(int $time): void
    {
        $this->time = $time;
    }
}
