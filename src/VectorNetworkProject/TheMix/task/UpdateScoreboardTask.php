<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\task;

use InkoHX\GoldLibrary\GoldAPI;
use InkoHX\LeveLibrary\LevelAPI;
use Miste\scoreboardspe\API\Scoreboard;
use pocketmine\Player;
use pocketmine\scheduler\Task;
use VectorNetworkProject\TheMix\game\corepvp\blue\BlueCoreManager;
use VectorNetworkProject\TheMix\game\corepvp\red\RedCoreManager;
use VectorNetworkProject\TheMix\game\streak\Streak;

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
     * @param Player     $player
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

            return;
        }
        $scoreboard = $this->scoreboard;
        $scoreboard->setLine($this->player, 0, '§7'.date('Y/m/d H:i:s'));
        $scoreboard->setLine($this->player, 2, '§l§cRED§r§7: §a'.RedCoreManager::getHP());
        $scoreboard->setLine($this->player, 3, '§l§bBLUE§r§7: §a'.BlueCoreManager::getHP());
        $scoreboard->setLine($this->player, 5, 'Level: '.LevelAPI::getLevel($this->player));
        $scoreboard->setLine($this->player, 6, 'Needed XP: §b'.LevelAPI::NeededXP($this->player));
        $scoreboard->setLine($this->player, 7, 'Gold: §6'.GoldAPI::getGold($this->player).'g');
        $scoreboard->setLine($this->player, 9, 'Streak: §c'.Streak::getStreak($this->player));
        $scoreboard->setLine($this->player, 10, 'Event: none');
        $scoreboard->setLine($this->player, 12, '§ewww.vector-network.tk  ');
    }
}
