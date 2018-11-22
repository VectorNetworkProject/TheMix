<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\game\level;

use pocketmine\Player;
use pocketmine\Server;
use VectorNetworkProject\TheMix\game\event\player\PlayerLevelChangeEvent;
use VectorNetworkProject\TheMix\provider\JSON;

class Level
{
    /* @var string */
    public const FILE_NAME = 'Level';

    /* @var string */
    public const LEVEL = 'level';

    public const MAX_LEVEL = 120;

    public static function init(Player $player): void
    {
        $db = new JSON($player, self::FILE_NAME);
        $db->init([
            'level'    => 1,
            'xp'       => 0,
            'max'      => 15,
            'prestige' => 0,
            'complete' => false,
        ]);
    }

    /**
     * プレイヤーのレベルを設定します。
     *
     * @param Player $player
     * @param int    $level
     *
     * @throws \Error
     *
     * @return void
     */
    public static function setLevel(Player $player, int $level): void
    {
        if (self::CheckLevel($level)) {
            throw new \Error('数値は120以下にして下さい。');
        }
        $event = new PlayerLevelChangeEvent($player, self::getLevel($player), $level, self::isComplete($level));
        Server::getInstance()->getPluginManager()->callEvent($event);
        if ($event->isCancelled()) {
            return;
        }
        $db = new JSON($player->getXuid(), self::FILE_NAME);
        $db->set(self::LEVEL, $level);
    }

    /**
     * プレイヤーのレベルを1上げます。
     *
     * @param Player $player
     *
     * @return void
     */
    public static function addLevel(Player $player): void
    {
        $level = self::getLevel($player);
        if (!$level >= 120) {
            return;
        }
        $event = new PlayerLevelChangeEvent($player, $level, $level + 1, self::isComplete($level + 1));
        Server::getInstance()->getPluginManager()->callEvent($event);
        if ($event->isCancelled()) {
            return;
        }
        $db = new JSON($player->getXuid(), self::FILE_NAME);
        $db->set(self::LEVEL, $level + 1);
    }

    /**
     * プレイヤーのレベルを返します。
     *
     * @param Player $player
     *
     * @return int
     */
    public static function getLevel(Player $player): int
    {
        $db = new JSON($player->getXuid(), self::FILE_NAME);

        return $db->get(self::LEVEL);
    }

    /**
     * レベルが120か調べる。
     *
     * @param int $level
     *
     * @return bool
     */
    public static function isComplete(int $level): bool
    {
        return $level >= self::MAX_LEVEL
            ? true
            : false;
    }

    /**
     * レベルが120を超えていないか調べる。
     *
     * @param int $level
     *
     * @return bool
     */
    private static function CheckLevel(int $level): bool
    {
        return $level > self::MAX_LEVEL
            ? true
            : false;
    }
}
