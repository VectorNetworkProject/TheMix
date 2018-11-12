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
use VectorNetworkProject\TheMix\lib\scoreboard\Scoreboard;

class UpdateScoreboardTask extends Task
{
    public function onRun(int $currentTick)
    {
        foreach (Server::getInstance()->getOnlinePlayers() as $player) {
            Scoreboard::setLine($player, 1, 'test');
            Scoreboard::setLine($player, 2, ' ');
            Scoreboard::setLine($player, 3, 'test');
        }
    }
}
