<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\game\streak;

use pocketmine\Player;

class Streak
{
    /** @var array $streaks */
    private static $streaks;

    /**
     * @param Player $player
     */
    public static function init(Player $player): void
    {
        self::$streaks[$player->getXuid()] = 0;
    }

    /**
     * @param Player $player
     */
    public static function addStreak(Player $player): void
    {
        self::$streaks[$player->getXuid()] += 1;
    }

    /**
     * @param Player $player
     * @return int
     */
    public static function getStreak(Player $player): int
    {
        return self::$streaks[$player->getXuid()];
    }

    /**
     * @param Player $player
     */
    public static function resetStreak(Player $player): void
    {
        self::$streaks[$player->getXuid()] = 0;
    }

    /**
     * @param Player $player
     */
    public static function unsetStreak(Player $player): void
    {
        if (isset(self::$streaks[$player->getXuid()])) {
            unset(self::$streaks[$player->getXuid()]);
        }
    }
}
