<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\event\level;


use InkoHX\LeveLibrary\event\xp\PlayerAddXpEvent;
use pocketmine\event\Listener;

class ThePlayerAddXpEvent implements Listener
{
    public function event(PlayerAddXpEvent $event)
    {
        $event->getPlayer()->sendMessage("§v{$event->getXp()}XP §fを手に入れた");
    }
}
