<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\game\corepvp\blue;

use pocketmine\level\Position;
use VectorNetworkProject\TheMix\game\corepvp\SpawnManager;
use VectorNetworkProject\TheMix\game\DefaultConfig;

class BlueSpawnManager extends SpawnManager
{

    /**
     * @return Position
     */
    public static function getPosition(): Position
    {
        $position = DefaultConfig::getBlueConfig();
        return new Position($position['x'], $position['y'], $position['z'], Server::getInstance()->getLevelByName(DefaultConfig::getStageLevelName()));
    }
}
