<?php
/**
 * Copyright (c) 2018 - 2019 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\game\corepvp;

use pocketmine\block\Block;
use pocketmine\Player;
use VectorNetworkProject\TheMix\game\corepvp\blue\BlueCoreManager;
use VectorNetworkProject\TheMix\game\corepvp\red\RedCoreManager;

abstract class CoreManager
{
    const MAX_HP = 100;

    public static function resetHP(): void
    {
        RedCoreManager::setHP(self::MAX_HP);
        BlueCoreManager::setHP(self::MAX_HP);
    }

    /**
     * @param int $hp
     */
    abstract public static function setHP(int $hp): void;

    /**
     * @param int $hp
     */
    abstract public static function addHP(int $hp): void;

    /**
     * @param int    $hp
     * @param Player $player
     */
    abstract public static function reduceHP(int $hp, Player $player): void;

    /**
     * @param Block $block
     *
     * @return bool
     */
    abstract public static function isCore(Block $block): bool;
}
