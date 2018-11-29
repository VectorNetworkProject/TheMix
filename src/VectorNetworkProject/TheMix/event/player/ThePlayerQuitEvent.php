<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\event\player;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerQuitEvent;
use VectorNetworkProject\TheMix\game\corepvp\blue\BlueTeamManager;
use VectorNetworkProject\TheMix\game\corepvp\red\RedTeamManager;

class ThePlayerQuitEvent implements Listener
{
    public function event(PlayerQuitEvent $event)
    {
        $player = $event->getPlayer();
        $event->setQuitMessage('§7[§c退出§7] §e'.$player->getName().'が退出しました。');
        RedTeamManager::removeList($player);
        BlueTeamManager::removeList($player);
    }
}
