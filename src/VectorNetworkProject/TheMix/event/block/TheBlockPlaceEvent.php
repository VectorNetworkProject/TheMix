<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\event\block;

use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\Listener;
use pocketmine\Server;
use VectorNetworkProject\TheMix\game\DefaultConfig;

class TheBlockPlaceEvent implements Listener
{
    public function event(BlockPlaceEvent $event)
    {
        $player = $event->getPlayer();
        if ($player->getLevel()->getName() === Server::getInstance()->getDefaultLevel()->getName()) {
            if ($player->isOp()) {
                return;
            }
            $event->setCancelled();
        } elseif ($player->getLevel()->getName() === DefaultConfig::getStageLevelName()) {
            if (DefaultConfig::isDev()) return;
            $event->setCancelled();
        }
    }
}
