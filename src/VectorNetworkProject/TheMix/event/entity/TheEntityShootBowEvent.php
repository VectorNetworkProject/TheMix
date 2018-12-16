<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

/**
 * Created by PhpStorm.
 * User: InkoHX
 * Date: 2018/12/16
 * Time: 13:41
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
