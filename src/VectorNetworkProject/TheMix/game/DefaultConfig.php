<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\game;

use pocketmine\level\Level;
use pocketmine\Server;
use VectorNetworkProject\TheMix\provider\YAML;
use VectorNetworkProject\TheMix\TheMix;

class DefaultConfig
{
    public const STAGE_NAME = 'stage-world-name';

    public static function init()
    {
        $db = new YAML();
        $db->init([
            'version' => TheMix::PLUGIN_CONFIG_VERSION,
            'stage-world-name' => 'stage'
        ]);
    }

    public static function getStageLevelName(): string
    {
        $db = new YAML();
        return $db->get(self::STAGE_NAME);
    }

    /**
     * @return Level|null
     */
    public static function getStageWorld(): ?Level
    {
        $db = new YAML();
        return Server::getInstance()->getLevelByName($db->get(self::STAGE_NAME));
    }
}
