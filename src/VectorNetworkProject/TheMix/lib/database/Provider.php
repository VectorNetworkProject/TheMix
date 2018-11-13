<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\lib\database;

use VectorNetworkProject\TheMix\TheMix;

abstract class Provider
{
    protected static function getPath(string $folder, string $type): string
    {
        return TheMix::getInstance()->getDataFolder().'/'.$folder.'/'.$type.'/';
    }
}
