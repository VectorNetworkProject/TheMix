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
use pocketmine\Server;
use VectorNetworkProject\TheMix\game\corepvp\CoreManager;
use VectorNetworkProject\TheMix\game\DefaultConfig;
use VectorNetworkProject\TheMix\game\event\game\GameWinEvent;

class BlueCoreManager extends CoreManager
{
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
     * @param int    $hp
     * @param Player $player
     */
    public static function reduceHP(int $hp, Player $player): void
    {
        self::$hp -= $hp;
        if (self::getHP() <= 0) {
            $event = new GameWinEvent(GameWinEvent::WIN_RED, $player);
            Server::getInstance()->getPluginManager()->callEvent($event);
            if ($event->isCancelled()) {
                self::addHP(1);
            }
        }
    }

    /**
     * @param Block $block
     *
     * @return bool
     */
    public static function isCore(Block $block): bool
    {
        $config = DefaultConfig::getBlueConfig();
        $core = $config['core'];
        if ($block->getLevel()->getName() !== DefaultConfig::getStageLevelName()) {
            return false;
        }
        if ($core['x'] === $block->x && $core['y'] === $block->y && $core['z'] === $block->z) {
            return true;
        } else {
            return false;
        }
    }
}
