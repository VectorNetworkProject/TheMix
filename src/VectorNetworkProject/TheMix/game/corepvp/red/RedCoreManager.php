<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\game\corepvp\red;


use pocketmine\block\Block;
use pocketmine\Player;
use VectorNetworkProject\TheMix\game\corepvp\CoreManager;

class RedCoreManager extends CoreManager
{

    /**
     * @param Block $block
     * @param Player $player
     */
    public static function Break(Block $block, Player $player): void
    {
        // TODO: Implement Break() method.
    }

    /**
     * @param int $hp
     * @param Player|null $player
     */
    public static function setHP(int $hp, Player $player = null): void
    {
        // TODO: Implement setHP() method.
    }

    /**
     * @param int $hp
     * @param Player|null $player
     */
    public static function addHP(int $hp, Player $player = null): void
    {
        // TODO: Implement addHP() method.
    }

    /**
     * @param int $hp
     * @param Player|null $player
     */
    public static function reduceHP(int $hp, Player $player = null): void
    {
        // TODO: Implement reduceHP() method.
    }

    /**
     * @param Block $block
     * @return bool
     */
    public static function isCore(Block $block): bool
    {
        // TODO: Implement isCore() method.
    }
}
