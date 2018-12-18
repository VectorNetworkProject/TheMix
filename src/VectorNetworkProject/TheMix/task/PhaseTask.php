<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\task;

use pocketmine\scheduler\Task;

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

    public function onRun(int $currentTick)
    {
        // TODO: Implement onRun() method.
    }

    /**
     * @return string
     */
    public function getTime(): string
    {
        return gmdate('i:s', $this->time);
    }
}
