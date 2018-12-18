<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\game\event\game;


use pocketmine\event\Cancellable;
use pocketmine\event\Event;

class PhaseTimeUpdateEvent extends Event implements Cancellable
{
    /** @var int $time */
    private $time;
    /** @var int $phase */
    private $phase;

    /**
     * PhaseTimeUpdateEvent constructor.
     *
     * @param int $time
     * @param int $phase
     */
    public function __construct(int $time, int $phase)
    {
        $this->time = $time;
        $this->phase = $phase;
    }

    /**
     * @return int
     */
    public function getTime(): int
    {
        return $this->time;
    }

    /**
     * @return int
     */
    public function getPhase(): int
    {
        return $this->phase;
    }
}
