<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\game\corepvp;

use pocketmine\Player;
use VectorNetworkProject\TheMix\game\corepvp\blue\BlueTeamManager;
use VectorNetworkProject\TheMix\game\corepvp\red\RedTeamManager;

abstract class TeamManager
{
    public static function JoinTeam(Player $player)
    {
        if (BlueTeamManager::isJoined($player) || RedTeamManager::isJoined($player)) {
            return;
        }
        if (BlueTeamManager::getListCount() < RedTeamManager::getListCount()) {
            BlueTeamManager::addList($player);
        } else {
            RedTeamManager::addList($player);
        }
    }

    abstract public static function addList(Player $player): void;

    abstract public static function removeList(Player $player): void;

    abstract public static function isJoined(Player $player): bool;

    abstract public static function getList(): array;
}
