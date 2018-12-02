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

class ResetGameTask extends Task
{
    public function onRun(int $currentTick)
    {
        foreach (Server::getInstance()->getOnlinePlayers() as $player) {
            $player->transfer("play.vector-network.tk", 19132, '再接続');
        }
        Server::getInstance()->shutdown();
    }
}
