<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\event\gold;

use InkoHX\GoldLibrary\event\PlayerAddGoldEvent;
use pocketmine\event\Listener;

class ThePlayerAddGoldEvent implements Listener
{
    /**
     * @param PlayerAddGoldEvent $event
     */
    public function event(PlayerAddGoldEvent $event)
    {
        $event->getPlayer()->sendMessage("§6{$event->getGold()}g §fを手に入れた。");
    }
}
