<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\task;

use pocketmine\scheduler\Task;
use pocketmine\Server;
use VectorNetworkProject\TheMix\game\DefaultConfig;

class ResetGameTask extends Task
{
    /**
     * @param int $currentTick
     */
    public function onRun(int $currentTick)
    {
        foreach (Server::getInstance()->getOnlinePlayers() as $player) {
            $player->transfer(DefaultConfig::getIp(), DefaultConfig::getPort(), '再接続');
        }
        Server::getInstance()->shutdown();
    }
}
