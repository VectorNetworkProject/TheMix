<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\event\player;

use pocketmine\block\Block;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use VectorNetworkProject\TheMix\game\corepvp\TeamManager;
use VectorNetworkProject\TheMix\game\DefaultConfig;

class ThePlayerInteractEvent implements Listener
{
    /**
     * @param PlayerInteractEvent $event
     */
    public function event(PlayerInteractEvent $event)
    {
        $player = $event->getPlayer();
        $block = $event->getBlock();
        if ($block->getId() === Block::NETHER_REACTOR) {
            if (DefaultConfig::isDev()) {
                return;
            }
            TeamManager::JoinTeam($player);
        }
    }
}
