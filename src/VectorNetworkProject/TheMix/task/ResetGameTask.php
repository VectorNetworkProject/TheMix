<?php
/**
 * Copyright (c) 2018 - 2019 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\task;

use pocketmine\scheduler\Task;
use VectorNetworkProject\TheMix\game\GameManager;

class ResetGameTask extends Task
{
    /**
     * @param int $currentTick
     */
    public function onRun(int $currentTick)
    {
        GameManager::resetGame();
    }
}
