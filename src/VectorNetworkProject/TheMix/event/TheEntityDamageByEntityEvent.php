<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\event;


use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\Player;
use VectorNetworkProject\TheMix\game\corepvp\SpawnManager;

class TheEntityDamageByEntityEvent implements Listener
{
    public function event(EntityDamageByEntityEvent $event)
    {
        $entity = $event->getEntity();
        $damager = $event->getDamager();
        $entity->extinguish();
        if ($event->getCause() === EntityDamageEvent::CAUSE_FALL) return;
        if ($event->getFinalDamage() < $entity->getHealth()) return;
        if ($entity instanceof Player && $damager instanceof Player) {
            $event->setCancelled();
            if ($entity->getName() === $damager->getName()) {
                // 自滅対策
                SpawnManager::PlayerReSpawn($entity);
            } else {
                SpawnManager::PlayerReSpawn($entity);
            }
        }
    }
}
