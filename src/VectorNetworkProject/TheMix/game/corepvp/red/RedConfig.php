<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\game\corepvp\red;


use VectorNetworkProject\TheMix\game\DefaultConfig;

class RedConfig extends DefaultConfig
{
    public static function getSpawn1(): array
    {
        return self::getRedConfig()['spawn1'];
    }

    public static function getSpawn2(): array
    {
        return self::getRedConfig()['spawn2'];
    }

    public static function getCore(): array
    {
        return self::getRedConfig()['core'];
    }
}
