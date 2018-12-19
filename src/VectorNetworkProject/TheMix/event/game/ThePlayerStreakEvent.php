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
    /**
     * @param PlayerStreakEvent $event
     */
    public function event(PlayerStreakEvent $event)
    {
        $player = $event->getPlayer();
        switch ($event->getCount()) {
            case 5:
            case 10:
            case 20:
            case 30:
            case 40:
            case 50:
            case 60:
            case 70:
            case 80:
            case 90:
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
