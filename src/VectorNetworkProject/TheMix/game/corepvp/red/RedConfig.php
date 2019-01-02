<?php
/**
 * Copyright (c) 2018 - 2019 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\game\corepvp\red;

use VectorNetworkProject\TheMix\game\DefaultConfig;

class RedConfig extends DefaultConfig
{
    /**
     * @return array
     */
    public static function getSpawn1(): array
    {
        return self::getRedConfig()['spawn1'];
    }

    /**
     * @return array
     */
    public static function getSpawn2(): array
    {
        return self::getRedConfig()['spawn2'];
    }

    /**
     * @return array
     */
    public static function getCore(): array
    {
        return self::getRedConfig()['core'];
    }
}
