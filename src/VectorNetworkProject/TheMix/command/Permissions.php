<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\command;

use pocketmine\permission\Permission;
use pocketmine\permission\PermissionManager;

class Permissions
{
    const USER = 'the.mix.commands.user.';
    const ADMIN = 'the.mix.commands.admin.';

    public static function registerPermissions(): void
    {
        PermissionManager::getInstance()->addPermission(new Permission(self::USER.'ping', '応答速度を計測します。', Permission::DEFAULT_TRUE));
        PermissionManager::getInstance()->addPermission(new Permission(self::USER.'tps', 'TicksPerSecond', Permission::DEFAULT_TRUE));
    }
}
