<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\task;

use Miste\scoreboardspe\API\Scoreboard;
use pocketmine\Player;
use pocketmine\scheduler\Task;
use pocketmine\Server;

class UpdateScoreboardTask extends Task
{
    /* @var Scoreboard $scoreboard */
    private $scoreboard;

    /* @var Player $player */
    private $player;

    /**
     * UpdateScoreboardTask constructor.
     *
     * @param Scoreboard $scoreboard
     * @param Player $player
     */
    public function __construct(Scoreboard $scoreboard, Player $player)
    {
        $this->scoreboard = $scoreboard;
        $this->player = $player;
    }

    /**
     * @param int $currentTick
     */
    public function onRun(int $currentTick)
    {
        if (!$this->player->isOnline()) {
            $this->getHandler()->cancel();
        }
        $scoreboard = $this->scoreboard;
        $scoreboard->setLine($this->player, 0, '§7'.date('Y/m/d H:i:s'));
        $scoreboard->setLine($this->player, 2, '§7Players: '.count(Server::getInstance()->getOnlinePlayers()).'/'.Server::getInstance()->getMaxPlayers());
        $scoreboard->setLine($this->player, 4, '§ewww.vector-network.tk     ');
    }
}
