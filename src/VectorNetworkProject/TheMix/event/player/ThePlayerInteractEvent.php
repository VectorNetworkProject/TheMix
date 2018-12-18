<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\event\player;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\Player;
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
        if ($block->getId() === DefaultConfig::getBlockId()) {
            if (DefaultConfig::isDev()) {
                return;
            }
            TeamManager::JoinTeam($player);
            $player->setGamemode(Player::SURVIVAL);
        }
    }
}
