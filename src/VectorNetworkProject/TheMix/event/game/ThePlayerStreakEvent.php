<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\event\game;

use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\Server;
use VectorNetworkProject\TheMix\game\event\player\PlayerStreakEvent;

class ThePlayerStreakEvent implements Listener
{
    public function event(PlayerStreakEvent $event)
    {
        $player = $event->getPlayer();
        switch ($event->getCount()) {
            case 5:
                $this->getStreakMessage($player, $event->getCount());
                break;
            case 10:
                $this->getStreakMessage($player, $event->getCount());
                break;
            case 20:
                $this->getStreakMessage($player, $event->getCount());
                break;
            case 30:
                $this->getStreakMessage($player, $event->getCount());
                break;
            case 50:
                $this->getStreakMessage($player, $event->getCount());
                break;
            case 100:
                $this->getStreakMessage($player, $event->getCount());
                break;
        }
    }

    /**
     * @param Player $player
     * @param int    $count
     */
    private function getStreakMessage(Player $player, int $count): void
    {
        Server::getInstance()->broadcastMessage("§l§cSTREAK! §r{$player->getName()}が{$count}回連続でキルしました！");
    }
}
