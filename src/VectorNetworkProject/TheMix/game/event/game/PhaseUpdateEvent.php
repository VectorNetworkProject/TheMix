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

class PhaseUpdateEvent extends Event implements Cancellable
{
    /** @var int $phase */
    private $phase;

    public function __construct(int $phase)
    {
        $this->phase = $phase;
    }

    /**
     * @return int
     */
    public function getPhase(): int
    {
        return $this->phase;
    }
}
