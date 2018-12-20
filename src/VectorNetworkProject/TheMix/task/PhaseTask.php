<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\task;

use pocketmine\scheduler\Task;
use VectorNetworkProject\TheMix\game\corepvp\PhaseManager;
use VectorNetworkProject\TheMix\game\event\game\PhaseTimeUpdateEvent;

class PhaseTask extends Task
{
    /** @var int $time */
    private static $time;

    /**
     * PhaseTask constructor.
     *
     * @param int $time
     */
    public function __construct(int $time = 600)
    {
        self::$time = $time;
    }

    /**
     * @param int $currentTick
     *
     * @throws \ReflectionException
     */
    public function onRun(int $currentTick)
    {
        $event = new PhaseTimeUpdateEvent(self::getTime() - 1, PhaseManager::getPhase());
        $event->call();
        if (!$event->isCancelled()) {
            self::setTime($this->getTime() - 1);
        }
    }

    /**
     * @return int
     */
    public static function getTime(): int
    {
        return self::$time;
    }

    /**
     * @param int $time
     */
    public static function setTime(int $time = 600): void
    {
        self::$time = $time;
    }
}
