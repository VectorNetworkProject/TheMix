<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\event;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\Server;
use VectorNetworkProject\TheMix\game\corepvp\blue\BlueCoreManager;
use VectorNetworkProject\TheMix\game\corepvp\blue\BlueTeamManager;
use VectorNetworkProject\TheMix\game\corepvp\red\RedCoreManager;
use VectorNetworkProject\TheMix\game\corepvp\red\RedTeamManager;
use VectorNetworkProject\TheMix\game\DefaultConfig;
use VectorNetworkProject\TheMix\lib\sound\LevelSounds;

class TheBlockBreakEvent implements Listener
{
    public function event(BlockBreakEvent $event)
    {
        $player = $event->getPlayer();
        $block = $event->getBlock();
        if ($player->getLevel()->getName() === Server::getInstance()->getDefaultLevel()->getName()) {
            if ($player->isOp()) return;
            $event->setCancelled();
        }
        if (!DefaultConfig::isDev()) {
            if (RedCoreManager::isCore($block)) {
                $event->setCancelled();
                if (RedTeamManager::isJoined($player)) return;
                RedCoreManager::reduceHP(1, $player);
                $block->getLevel()->broadcastLevelSoundEvent($block->asVector3(), LevelSoundEventPacket::SOUND_RANDOM_ANVIL_USE, mt_rand(1, 5));
                foreach (Server::getInstance()->getOnlinePlayers() as $player) {
                    LevelSounds::NotePiano($player, 20);
                }
            } elseif (BlueCoreManager::isCore($block)) {
                $event->setCancelled();
                if (BlueTeamManager::isJoined($player)) return;
                BlueCoreManager::reduceHP(1, $player);
                $block->getLevel()->broadcastLevelSoundEvent($block->asVector3(), LevelSoundEventPacket::SOUND_RANDOM_ANVIL_USE, mt_rand(1, 5));
                foreach (Server::getInstance()->getOnlinePlayers() as $player) {
                    LevelSounds::NotePiano($player, 20);
                }
            }
        } else {
            $event->setCancelled();
        }
    }
}
