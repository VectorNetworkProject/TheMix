<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\event\block;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\Server;
use VectorNetworkProject\TheMix\event\game\TheEndGameEvent;
use VectorNetworkProject\TheMix\game\corepvp\blue\BlueCoreManager;
use VectorNetworkProject\TheMix\game\corepvp\blue\BlueTeamManager;
use VectorNetworkProject\TheMix\game\corepvp\red\RedCoreManager;
use VectorNetworkProject\TheMix\game\corepvp\red\RedTeamManager;
use VectorNetworkProject\TheMix\game\DefaultConfig;
use VectorNetworkProject\TheMix\game\event\game\BreakCoreEvent;

class TheBlockBreakEvent implements Listener
{
    /**
     * @param BlockBreakEvent $event
     *
     * @throws \ReflectionException
     */
    public function event(BlockBreakEvent $event)
    {
        $player = $event->getPlayer();
        $block = $event->getBlock();
        if (TheEndGameEvent::isFinish()) {
            $event->setCancelled();

            return;
        }
        if ($player->getLevel()->getName() === Server::getInstance()->getDefaultLevel()->getName()) {
            if ($player->isOp()) {
                return;
            }
            $event->setCancelled();
        }
        if (!DefaultConfig::isDev()) {
            if (RedCoreManager::isCore($block)) {
                $event->setCancelled();
                if (RedTeamManager::isJoined($player)) {
                    return;
                }
                $revent = new BreakCoreEvent($player, BreakCoreEvent::RED);
                $revent->call();
                if (!$revent->isCancelled()) {
                    RedCoreManager::reduceHP($revent->getDamage(), $player);
                }
            } elseif (BlueCoreManager::isCore($block)) {
                $event->setCancelled();
                if (BlueTeamManager::isJoined($player)) {
                    return;
                }
                $bevent = new BreakCoreEvent($player, BreakCoreEvent::BLUE);
                $bevent->call();
                if (!$bevent->isCancelled()) {
                    BlueCoreManager::reduceHP($bevent->getDamage(), $player);
                }
            }
        }
    }
}
