<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\event;


use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\Listener;
use pocketmine\math\Vector2;
use VectorNetworkProject\TheMix\game\DefaultConfig;

class TheBlockPlaceEvent implements Listener
{
    public function event(BlockPlaceEvent $event)
    {
        $block = $event->getBlock();
        $red = DefaultConfig::getRedSafe();
        $blue = DefaultConfig::getBlueSafe();
        $redsafe = new Vector2($red['x'], $blue['z']);
        $bluesafe = new Vector2($blue['x'], $blue['z']);
        if ($redsafe->distance($block->x, $block->z) <= $red['diameter'] || $bluesafe->distance($block->x, $block->z) <= $blue['diameter']) {
            if (!DefaultConfig::isDev()) {
                $event->setCancelled();
            }
        }
    }
}
