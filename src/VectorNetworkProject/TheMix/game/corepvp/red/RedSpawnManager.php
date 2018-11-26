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
     * @return Position
     */
    public static function getPosition(): Position
    {
        $position = DefaultConfig::getRedConfig();
        return new Position($position['x'], $position['y'], $position['z'], Server::getInstance()->getLevelByName(DefaultConfig::getStageLevelName()));
    }
}
