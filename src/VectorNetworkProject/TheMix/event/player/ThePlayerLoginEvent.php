<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\event\player;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerLoginEvent;
use VectorNetworkProject\TheMix\game\bounty\Bounty;
use VectorNetworkProject\TheMix\game\streak\Streak;

class ThePlayerLoginEvent implements Listener
{
    public function event(PlayerLoginEvent $event)
    {
        $player = $event->getPlayer();
        Bounty::init($player);
        Streak::init($player);
    }
}
