<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\game\corepvp;

use VectorNetworkProject\TheMix\game\event\game\PhaseUpdateEvent;

class PhaseManager
{
    /** @var int */
    public const MAX_PHASE = 5;

    /** @var int $phase */
    private static $phase = 1;

    /**
     * @throws \ReflectionException
     */
    public static function addPhase(): void
    {
        $event = new PhaseUpdateEvent(self::getPhase() + 1);
        $event->call();
        if (!$event->isCancelled()) {
            self::$phase++;
        }
    }

    /**
     * @return int
     */
    public static function getPhase(): int
    {
        return self::$phase;
    }
}
