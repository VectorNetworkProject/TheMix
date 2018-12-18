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
 * Date: 2018/12/18
 * Time: 0:53.
 */

namespace VectorNetworkProject\TheMix\game\corepvp;

class PhaseManager
{
    /** @var int */
    public const MAX_PHASE = 5;
    /** @var int $phase */
    private static $phase = 1;

    public static function addPhase(): void
    {
        if (self::$phase <= self::MAX_PHASE) {
            return;
        }
        self::$phase++;
    }

    /**
     * @return int
     */
    public static function getPhase(): int
    {
        return self::$phase;
    }
}
