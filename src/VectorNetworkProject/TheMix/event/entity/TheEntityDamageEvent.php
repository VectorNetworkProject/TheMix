<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\event\entity;

use InkoHX\GoldLibrary\GoldAPI;
use InkoHX\LeveLibrary\LevelAPI;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\Player;
use VectorNetworkProject\TheMix\event\game\TheEndGameEvent;
use VectorNetworkProject\TheMix\game\corepvp\SpawnManager;
use VectorNetworkProject\TheMix\game\streak\Streak;

class TheEntityDamageEvent implements Listener
{
    public function event(EntityDamageEvent $event)
    {
        $entity = $event->getEntity();
        $entity->extinguish();
        if (TheEndGameEvent::isFinish()) return;
        if (!$entity instanceof Player) return;
        if ($event->getFinalDamage() < $entity->getHealth()) return;
        if ($event->getCause() === EntityDamageEvent::CAUSE_FALL) return;
        if ($event instanceof EntityDamageByEntityEvent) {
            $event->setCancelled();
            SpawnManager::PlayerReSpawn($entity);
            Streak::resetStreak($entity);
            $damager = $event->getDamager();
            if ($damager instanceof Player) {
                if ($entity->getName() === $damager->getName()) return;
                Streak::addStreak($damager);
                GoldAPI::addGold($damager, mt_rand(10, 15));
                LevelAPI::Auto($damager, mt_rand(10, 15));
            }
        } else {
            $event->setCancelled();
            Streak::resetStreak($entity);
            SpawnManager::PlayerReSpawn($entity);
        }
    }
}
