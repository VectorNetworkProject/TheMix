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
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\Server;
use VectorNetworkProject\TheMix\event\game\TheEndGameEvent;
use VectorNetworkProject\TheMix\game\corepvp\blue\BlueTeamManager;
use VectorNetworkProject\TheMix\game\corepvp\red\RedTeamManager;
use VectorNetworkProject\TheMix\game\corepvp\SpawnManager;
use VectorNetworkProject\TheMix\game\streak\Streak;

class TheEntityDamageEvent implements Listener
{
    /**
     * @param EntityDamageEvent $event
     *
     * @throws \ReflectionException
     */
    public function event(EntityDamageEvent $event)
    {
        $entity = $event->getEntity();
        $entity->extinguish();
        if (TheEndGameEvent::isFinish()) {
            $event->setCancelled();

            return;
        }
        if (!$entity instanceof Player) {
            return;
        }
        if ($event->getFinalDamage() < $entity->getHealth()) {
            return;
        }
        if ($event->getCause() === EntityDamageEvent::CAUSE_FALL) {
            $event->setCancelled();

            return;
        }
        if ($entity->getLevel()->getName() === Server::getInstance()->getDefaultLevel()->getName()) {
            $event->setCancelled();

            return;
        }
        if ($event instanceof EntityDamageByEntityEvent) {
            $event->setCancelled();
            $damager = $event->getDamager();
            self::dropItem($entity);
            SpawnManager::PlayerReSpawn($entity);
            Streak::resetStreak($entity);
            if ($damager instanceof Player) {
                if ($entity->getName() === $damager->getName()) {
                    Server::getInstance()->broadcastMessage("{$entity->getNameTag()} §fは自滅した。");

                    return;
                }
                Streak::addStreak($damager);
                GoldAPI::addGold($damager, mt_rand(10, 15));
                LevelAPI::Auto($damager, mt_rand(10, 15));
                Server::getInstance()->broadcastMessage("{$damager->getNameTag()} §fが {$entity->getNameTag()} §fを倒した。");
            }
        } else {
            $event->setCancelled();
            self::dropItem($entity);
            Streak::resetStreak($entity);
            SpawnManager::PlayerReSpawn($entity);
            Server::getInstance()->broadcastMessage("{$entity->getNameTag()} §fは自滅した。");
        }
    }

    /**
     * @param EntityDamageEvent $event
     */
    public function BlockTeamPvP(EntityDamageEvent $event)
    {
        if ($event instanceof EntityDamageByEntityEvent) {
            $entity = $event->getEntity();
            $damager = $event->getDamager();
            if (!$entity instanceof Player && !$damager instanceof Player) {
                return;
            }
            if (BlueTeamManager::isJoined($entity) === true && BlueTeamManager::isJoined($damager) === true) {
                $event->setCancelled();
            } elseif (RedTeamManager::isJoined($entity) === true && RedTeamManager::isJoined($damager) === true) {
                $event->setCancelled();
            }
        }
    }

    /**
     * @param Player $player
     * @return void
     */
    public static function dropItem(Player $player): void
    {
        $contents = $player->getInventory()->getContents();
        foreach ($contents as $slot => $item) {
            switch ($item->getId()) {
                case Item::STONE_AXE:
                case Item::STONE_PICKAXE:
                case Item::STONE_SHOVEL:
                case Item::WOODEN_SWORD:
                case Item::LEATHER_CAP:
                case Item::LEATHER_CHESTPLATE:
                case Item::LEATHER_LEGGINGS:
                case Item::LEATHER_BOOTS:
                case Item::BOW:
                    unset($contents[$slot]);
                    break;
            }
        }
        foreach ($contents as $item) {
            $player->getLevel()->dropItem($player->asVector3(), $item);
        }
    }
}
