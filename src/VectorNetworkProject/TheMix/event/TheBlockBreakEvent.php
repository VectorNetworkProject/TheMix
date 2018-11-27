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
use pocketmine\math\Math;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\Server;
use VectorNetworkProject\TheMix\game\corepvp\blue\BlueCoreManager;
use VectorNetworkProject\TheMix\game\corepvp\red\RedCoreManager;
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
        if (RedCoreManager::isCore($block)) {
            $event->setCancelled();
            RedCoreManager::reduceHP(1);
            $block->getLevel()->broadcastLevelSoundEvent($block->asVector3(), LevelSoundEventPacket::SOUND_RANDOM_ANVIL_USE, Math::floorFloat(mt_rand(8, 10) / 10));
            foreach (Server::getInstance()->getOnlinePlayers() as $player) {
                LevelSounds::NotePiano($player, 3);
            }
        } elseif (BlueCoreManager::isCore($block)) {
            $event->setCancelled();
            BlueCoreManager::reduceHP(1);
            $block->getLevel()->broadcastLevelSoundEvent($block->asVector3(), LevelSoundEventPacket::SOUND_RANDOM_ANVIL_USE, Math::floorFloat(mt_rand(8, 10) / 10));
            foreach (Server::getInstance()->getOnlinePlayers() as $player) {
                LevelSounds::NotePiano($player, 3);
            }
        }
    }
}
