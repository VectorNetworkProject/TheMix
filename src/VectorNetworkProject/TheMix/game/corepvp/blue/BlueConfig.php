<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\game\corepvp\blue;


use VectorNetworkProject\TheMix\game\DefaultConfig;

class BlueConfig extends DefaultConfig
{
    /**
     * @return array
     */
    public static function getSpawn1(): array
    {
        return self::getBlueConfig()['spawn1'];
    }

    /**
     * @return array
     */
    public static function getSpawn2(): array
    {
        return self::getBlueConfig()['spawn2'];
    }

    /**
     * @return array
     */
    public static function getCore(): array
    {
        return self::getBlueConfig()['core'];
    }
}
