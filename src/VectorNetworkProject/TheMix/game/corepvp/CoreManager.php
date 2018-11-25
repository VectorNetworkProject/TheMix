<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\game\corepvp;


use pocketmine\block\Block;
use pocketmine\Player;

abstract class CoreManager
{
    /**
     * @param Block $block
     * @param Player $player
     */
    abstract public static function Break(Block $block, Player $player): void;

    /**
     * @param int $hp
     * @param Player|null $player
     */
    abstract public static function setHP(int $hp, Player $player = null): void;

    /**
     * @param int $hp
     * @param Player|null $player
     */
    abstract public static function addHP(int $hp, Player $player = null): void;

    /**
     * @param int $hp
     * @param Player|null $player
     */
    abstract public static function reduceHP(int $hp, Player $player = null): void;

    /**
     * @param Block $block
     * @return bool
     */
    abstract public static function isCore(Block $block): bool;
}
