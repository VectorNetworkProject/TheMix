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
use VectorNetworkProject\TheMix\game\DefaultConfig;

class RedCoreManager extends CoreManager
{
    /* @var bool $enabled */
    private static $enabled = true;

    /** @var int $hp */
    private static $hp = 75;

    /**
     * @param int $hp
     */
    public static function setHP(int $hp): void
    {
        self::$hp = $hp;
    }

    /**
     * @param int $hp
     */
    public static function addHP(int $hp): void
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
     */
    public static function reduceHP(int $hp): void
    {
        self::$hp -= $hp;
    }

    /**
     * @param Block $block
     * @return bool
     */
    public static function isCore(Block $block): bool
    {
        $config = DefaultConfig::getRedConfig();
        $core = $config['core'];
        if ($block->getLevel()->getName() !== DefaultConfig::getStageLevelName()) return false;
        if ($core['x'] === $block->x && $core['y'] === $block->y && $core['z'] === $block->z) {
            return true;
        } else {
            return false;
        }
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
