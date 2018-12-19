<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\event;

use pocketmine\event\entity\ItemSpawnEvent;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use VectorNetworkProject\TheMix\game\DefaultConfig;

class LevelEventListener implements Listener
{
    /**
     * @param ItemSpawnEvent $event
     */
    public function onItemSpawn(ItemSpawnEvent $event)
    {
        if (DefaultConfig::isDev()) {
            return;
        }
        switch ($event->getEntity()->getItem()->getId()) {
            case Item::LEATHER_CAP:
            case Item::LEATHER_CHESTPLATE:
            case Item::LEATHER_LEGGINGS:
            case Item::LEATHER_BOOTS:
                $event->getEntity()->kill();
                break;
        }
    }
}
