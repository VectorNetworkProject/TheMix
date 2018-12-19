<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\event;


use InkoHX\GoldLibrary\event\PlayerAddGoldEvent;
use InkoHX\LeveLibrary\event\level\PlayerLevelUpEvent;
use InkoHX\LeveLibrary\event\xp\PlayerAddXpEvent;
use pocketmine\event\Listener;

class LibraryEventListener implements Listener
{
    /**
     * @param PlayerAddGoldEvent $event
     */
    public function onAddGold(PlayerAddGoldEvent $event)
    {
        $event->getPlayer()->sendMessage("§6{$event->getGold()}g §fを手に入れた。");
    }

    /**
     * @param PlayerAddXpEvent $event
     */
    public function onAddXp(PlayerAddXpEvent $event)
    {
        $event->getPlayer()->sendMessage("§b{$event->getXp()}XP §fを手に入れた");
    }

    /**
     * @param PlayerLevelUpEvent $event
     */
    public function onLevelUp(PlayerLevelUpEvent $event)
    {
        $player = $event->getPlayer();
        $player->sendMessage("§l§bLEVEL UP! §f{$event->getOldLevel()} §7> §f{$event->getNewLevel()}");
        $player->addTitle('§l§bLEVEL UP!', "{$event->getOldLevel()} §7> §f{$event->getNewLevel()}", -1, 100, 20);
    }
}
