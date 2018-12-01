<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\event\level;


use InkoHX\LeveLibrary\event\level\PlayerLevelUpEvent;
use pocketmine\event\Listener;

class TheLevelUpEvent implements Listener
{
    public function event(PlayerLevelUpEvent $event)
    {
        $player = $event->getPlayer();
        $player->sendMessage("§l§bLEVEL UP! §f{$event->getOldLevel()} §7> §f{$event->getNewLevel()}");
        $player->addTitle('§l§bLEVEL UP!', "{$event->getOldLevel()} §7> §f{$event->getNewLevel()}", -1, 100, 20);
    }
}
