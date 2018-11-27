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
        if (!$entity instanceof Player) return;
        if ($damager instanceof Player) {
            if ($entity->getName() === $damager->getName()) {
                $event->setCancelled();
                SpawnManager::PlayerReSpawn($entity);
            } else {
                $event->setCancelled();
                SpawnManager::PlayerReSpawn($entity);
            }
        } else {
            $event->setCancelled();
            SpawnManager::PlayerReSpawn($entity);
        }
    }
}
