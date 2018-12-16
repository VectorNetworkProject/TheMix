<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\event\entity;

use pocketmine\event\entity\EntityShootBowEvent;
use pocketmine\event\Listener;

class TheEntityShootBowEvent implements Listener
{
    public function event(EntityShootBowEvent $event)
    {
        $event->setForce($event->getForce() + 0.5);
    }
}
