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
                'spawn1' => [
                    'x' => -131,
                    'y' => 81,
                    'z' => 25,
                ],
                'spawn2' => [
                    'x' => -131,
                    'y' => 81,
                    'z' => -25,
                ],
                'core' => [
                    'x' => -152,
                    'y' => 85,
                    'z' => 0
                ]
            ],
            'blue' => [
                'spawn1' => [
                    'x' => 131,
                    'y' => 81,
                    'z' => -25,
                ],
                'spawn2' => [
                    'x' => -131,
                    'y' => 81,
                    'z' => 25,
                ],
                'core' => [
                    'x' => 152,
                    'y' => 85,
                    'z' => 0
                ]
            ],
        ]);
    }

    public static function getStageLevelName(): string
    {
        $db = new YAML();

        return $db->get(self::STAGE_NAME);
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

    public static function getRedConfig(): array
    {
        $db = new YAML();
        return $db->get(self::RED);
    }

    public static function getBlueConfig(): array
    {
        $db = new YAML();
        return $db->get(self::BLUE);
    }
}
