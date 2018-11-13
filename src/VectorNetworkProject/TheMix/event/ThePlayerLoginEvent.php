<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\event;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerLoginEvent;
use VectorNetworkProject\TheMix\provider\DataFile;
use VectorNetworkProject\TheMix\provider\JSON;

class ThePlayerLoginEvent implements Listener
{
    public function event(PlayerLoginEvent $event)
    {
        $player = $event->getPlayer();
        $db = new JSON($player->getXuid(), DataFile::PLAYER_LEVEL);
        $db->init();
    }
}
