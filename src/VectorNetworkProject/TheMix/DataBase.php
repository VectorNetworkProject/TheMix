<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix;


use VectorNetworkProject\TheMix\provider\JSON;
use VectorNetworkProject\TheMix\provider\YAML;

class DataBase
{
    /**
     * @param string $xuid
     * @param string $file
     * @return JSON
     */
    public static function JsonUserSetting(string $xuid, $file = "UserDatas"): JSON
    {
        return new JSON($xuid, $file);
    }

    /**
     * @return YAML
     */
    public static function YamlClientSetting(): YAML
    {
        return new YAML();
    }
}
