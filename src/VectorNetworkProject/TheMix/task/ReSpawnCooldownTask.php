<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\task;


use pocketmine\Player;
use pocketmine\scheduler\Task;
use pocketmine\utils\TextFormat;

class ReSpawnCooldownTask extends Task
{
    /** @var Player $player */
    private $player;

    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    public function onRun(int $currentTick)
    {
        $this->player->setInvisible(false);
        $this->player->setImmobile(false);
        $this->player->sendMessage(TextFormat::GREEN.'行動可能になりました。');
    }
}
