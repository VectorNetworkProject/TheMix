<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\game\corepvp\red;


use pocketmine\level\Position;
use pocketmine\Server;
use VectorNetworkProject\TheMix\game\corepvp\SpawnManager;
use VectorNetworkProject\TheMix\game\DefaultConfig;

class RedSpawnManager extends SpawnManager
{
    /**
     * @return Position|null
     */
    public static function getRandomPosition(): ?Position
    {
        $position1 = DefaultConfig::getRedConfig()['spawn1'];
        $position2 = DefaultConfig::getRedConfig()['spawn2'];
        switch (mt_rand(1, 2)) {
            case 1:
                return new Position($position1['x'] . $position1['y'], $position1['z'], Server::getInstance()->getLevelByName(DefaultConfig::getStageLevelName()));
                break;
            case 2:
                return new Position($position2['x'] . $position2['y'], $position2['z'], Server::getInstance()->getLevelByName(DefaultConfig::getStageLevelName()));
                break;
            default:
                return null;
        }
    }
}
