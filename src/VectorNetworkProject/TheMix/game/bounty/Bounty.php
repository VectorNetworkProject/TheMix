<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\game\bounty;

use pocketmine\Player;
use VectorNetworkProject\TheMix\game\event\player\PlayerBountyEvent;
use VectorNetworkProject\TheMix\game\event\player\PlayerBountyLostEvent;
use VectorNetworkProject\TheMix\provider\JSON;

class Bounty
{
    /* @var string */
    public const FILE_NAME = 'Bounty';

    /* @var int */
    public const MAX_GOLD = 500;

    /* @var string */
    public const CONFIG_GOLD = 'gold';

    /* @var string */
    public const CONFIG_BOUNTY = 'bounty';

    public static function init(Player $player): void
    {
        $db = new JSON($player->getXuid(), self::FILE_NAME);
        $db->init([
            'gold' => 0,
            'bounty' => false,
        ]);
    }

    /**
     * プレイヤーに賭ける賞金を設定します。
     *
     * @param Player $player
     * @param int $gold
     *
     * @throws \Error
     */
    public static function setGold(Player $player, int $gold): void
    {
        if ($gold >= self::MAX_GOLD) {
            throw new \Error('Goldは500以下に設定して下さい。');
        }
        $db = new JSON($player->getXuid(), self::FILE_NAME);
        $db->set(self::CONFIG_GOLD, $gold);
    }

    /**
     * プレイヤーに賭けられている賞金を返します。
     *
     * @param Player $player
     *
     * @return int
     */
    public static function getGold(Player $player): int
    {
        $db = new JSON($player->getXuid(), self::FILE_NAME);

        return $db->get(self::CONFIG_GOLD);
    }

    /**
     * @param Player $player
     * @param bool $bounty
     */
    public static function setBounty(Player $player, bool $bounty): void
    {
        $db = new JSON($player, self::FILE_NAME);
        $db->set(self::CONFIG_BOUNTY, $bounty);
    }

    /**
     * プレイヤーに賞金が賭けられているかどうかを返します。
     *
     * @param Player $player
     *
     * @return bool
     */
    public static function isBounty(Player $player): bool
    {
        $db = new JSON($player, self::FILE_NAME);

        return $db->get(self::CONFIG_BOUNTY);
    }

    /**
     * @param Player $player
     *
     * @throws \ReflectionException
     */
    public static function setPlayerBounty(Player $player): void
    {
        if (self::isBounty($player)) {
            $gold = self::getGold($player) + 100;
            $event = new PlayerBountyEvent($player, $gold, PlayerBountyEvent::PLUS_GOLD);
            $event->call();
            if (!$event->isCancelled()) {
                self::setGold($player, $gold);
            }
        } else {
            $event = new PlayerBountyEvent($player, 100, PlayerBountyEvent::ENABLE_BOUNTY);
            $event->call();
            if (!$event->isCancelled()) {
                self::setBounty($player, true);
                self::setGold($player, 100);
            }
        }
    }

    /**
     * @param Player $player
     * @param Player|null $killer
     *
     * @throws \ReflectionException
     */
    public static function PlayerBountyLost(Player $player, Player $killer = null): void
    {
        if (!self::isBounty($player)) {
            return;
        }
        if ($killer) {
            $event = new PlayerBountyLostEvent($player, self::getGold($player));
            $event->call();
            if (!$event->isCancelled()) {
                self::setBounty($player, false);
                self::setGold($player, 0);
            }
        } else {
            $event = new PlayerBountyLostEvent($player, self::getGold($player), $killer, PlayerBountyLostEvent::TYPE_KILLED);
            $event->call();
            if (!$event->isCancelled()) {
                self::setBounty($player, false);
                self::setGold($player, 0);
            }
        }
    }
}
