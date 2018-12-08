<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\game\streak;

use pocketmine\Player;
use VectorNetworkProject\TheMix\game\event\player\PlayerStreakEvent;

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
     *
     * @throws \ReflectionException
     */
    public static function addStreak(Player $player): void
    {
        $event = new PlayerStreakEvent($player, self::getStreak($player) + 1);
        $event->call();
        if (!$event->isCancelled()) {
            self::$streaks[$player->getXuid()] += 1;
        }
    }

    /**
     * @param Player $player
     *
     * @return int
     */
    public static function getStreak(Player $player): int
    {
        return isset(self::$streaks[$player->getXuid()])
            ? self::$streaks[$player->getXuid()]
            : 0;
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
