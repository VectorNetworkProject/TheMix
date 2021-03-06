<?php
/**
 * Copyright (c) 2018 - 2019 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\game\corepvp;

use pocketmine\Player;
use VectorNetworkProject\TheMix\game\corepvp\blue\BlueSpawnManager;
use VectorNetworkProject\TheMix\game\corepvp\blue\BlueTeamManager;
use VectorNetworkProject\TheMix\game\corepvp\red\RedSpawnManager;
use VectorNetworkProject\TheMix\game\corepvp\red\RedTeamManager;
use VectorNetworkProject\TheMix\game\kit\BlueKit;
use VectorNetworkProject\TheMix\game\kit\RedKit;

abstract class TeamManager
{
    /**
     * @param Player $player
     */
    public static function JoinTeam(Player $player)
    {
        if (BlueTeamManager::isJoined($player) || RedTeamManager::isJoined($player)) {
            return;
        }
        if (BlueTeamManager::getListCount() < RedTeamManager::getListCount()) {
            BlueTeamManager::addList($player);
            BlueKit::sendItems($player);
            $player->teleport(BlueSpawnManager::getRandomPosition());
            $player->setNameTag("§b{$player->getName()}§r");
            $player->setDisplayName("§b{$player->getName()}§r");
            $player->sendMessage('§bBLUE§fに入りました。');
        } else {
            RedTeamManager::addList($player);
            RedKit::sendItem($player);
            $player->teleport(RedSpawnManager::getRandomPosition());
            $player->setNameTag("§c{$player->getName()}§r");
            $player->setDisplayName("§c{$player->getName()}§r");
            $player->sendMessage('§cRED§fに入りました。');
        }
    }

    public static function resetTeam(): void
    {
        RedTeamManager::ClearList();
        BlueTeamManager::ClearList();
    }

    /**
     * @param Player $player
     */
    abstract public static function addList(Player $player): void;

    /**
     * @param Player $player
     */
    abstract public static function removeList(Player $player): void;

    /**
     * @param Player $player
     *
     * @return bool
     */
    abstract public static function isJoined(Player $player): bool;

    /**
     * @return array
     */
    abstract public static function getList(): array;
}
