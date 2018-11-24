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

    public const DEVELOP_MODE = 'develop-mode';

    public const EVENT_TIME = 'event-time';

    public const RED = 'red';

    public const BLUE = 'blue';

    public static function init()
    {
        $db = new YAML();
        $db->init([
            'version' => TheMix::PLUGIN_CONFIG_VERSION,
            'develop-mode' => true,
            'stage-world-name' => 'stage',
            'event-time' => 30,
            'red' => [
                'safe' => [
                    'x' => 353,
                    'z' => 203,
                    'diameter' => 30,
                ],
                'spawn' => [
                    'x' => 245,
                    'y' => 424,
                    'z' => 452,
                ],
                'core' => [
                    'x' => 215,
                    'y' => 445,
                    'z' => 455,
                ]
            ],
            'blue' => [
                'safe' => [
                    'x' => 157,
                    'z' => 203,
                    'diameter' => 30,
                ],
                'spawn' => [
                    'x' => 245,
                    'y' => 424,
                    'z' => 452,
                ],
                'core' => [
                    'x' => 215,
                    'y' => 445,
                    'z' => 455,
                ]
            ]
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

    public static function isDev(): bool
    {
        $db = new YAML();
        return $db->get(self::DEVELOP_MODE);
    }

    public static function getEventTime(): int
    {
        $db = new YAML();
        return $db->get(self::EVENT_TIME);
    }

    public static function getRedSafe(): array
    {
        $db = new YAML();
        $safe = $db->get(self::RED);
        return $safe['safe'];
    }

    public static function getBlueSafe(): array
    {
        $db = new YAML();
        $safe = $db->get(self::BLUE);
        return $safe['safe'];
    }
}
