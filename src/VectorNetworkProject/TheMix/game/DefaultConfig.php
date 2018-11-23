<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\game;


use VectorNetworkProject\TheMix\provider\YAML;
use VectorNetworkProject\TheMix\TheMix;

class DefaultConfig
{
    public static function init()
    {
        $db = new YAML();
        $db->init([
            'version' => TheMix::PLUGIN_CONFIG_VERSION,
            'name-fix' => false
        ]);
    }
}
