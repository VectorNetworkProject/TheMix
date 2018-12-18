<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

/**
 * Created by PhpStorm.
 * User: InkoHX
 * Date: 2018/12/19
 * Time: 4:54.
 */

namespace VectorNetworkProject\TheMix\game\event\game;

use pocketmine\event\Cancellable;
use pocketmine\event\Event;

class PhaseTimeUpdateEvent extends Event implements Cancellable
{
    /** @var int $time */
    private $time;

    /**
     * PhaseTimeUpdateEvent constructor.
     *
     * @param int $time
     */
    public function __construct(int $time)
    {
        $this->time = $time;
    }

    /**
     * @return int
     */
    public function getTime(): int
    {
        return $this->time;
    }
}
