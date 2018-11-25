<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\game\corepvp\blue;


use pocketmine\block\Block;
use pocketmine\Player;
use VectorNetworkProject\TheMix\game\corepvp\CoreManager;

class BlueCoreManager extends CoreManager
{
    /* @var bool $enabled */
    private static $enabled = true;

    /** @var int $hp */
    private static $hp = 75;

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
        self::$hp = $hp;
    }

    /**
     * @param int $hp
     * @param Player|null $player
     */
    public static function addHP(int $hp, Player $player = null): void
    {
        self::$hp += $hp;
    }

    /**
     * @return int
     */
    public static function getHP(): int
    {
        return self::$hp;
    }

    /**
     * @param int $hp
     * @param Player|null $player
     */
    public static function reduceHP(int $hp, Player $player = null): void
    {
        self::$hp -= $hp;
    }

    /**
     * @param Block $block
     * @return bool
     */
    public static function isCore(Block $block): bool
    {
        // TODO: Implement isCore() method.
    }

    /**
     * @return bool
     */
    public static function isEnabled(): bool
    {
        return self::$enabled;
    }

    /**
     * @param bool $enabled
     */
    public static function setEnabled(bool $enabled): void
    {
        self::$enabled = $enabled;
    }
}
