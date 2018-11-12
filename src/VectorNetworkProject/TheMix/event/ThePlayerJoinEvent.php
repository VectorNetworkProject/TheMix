<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\event;


use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use VectorNetworkProject\TheMix\lib\scoreboard\Scoreboard;

class ThePlayerJoinEvent implements Listener
{
    public function event(PlayerJoinEvent $event)
    {
        $player = $event->getPlayer();
        Scoreboard::addBoard($player);
    }
}
