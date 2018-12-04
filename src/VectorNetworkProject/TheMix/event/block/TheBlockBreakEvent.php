<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\event\block;

use InkoHX\GoldLibrary\GoldAPI;
use InkoHX\LeveLibrary\LevelAPI;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\Server;
use VectorNetworkProject\TheMix\event\game\TheEndGameEvent;
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
                if (RedTeamManager::getListCount() < 1 || BlueTeamManager::getListCount() < 1) {
                    $player->sendMessage('プレイヤーが足りないのでコアを破壊する事が出来ません。');
                    $event->setCancelled();

                    return;
                }
                RedCoreManager::reduceHP(1, $player);
                GoldAPI::addGold($player, 15);
                LevelAPI::Auto($player, 10);
                Server::getInstance()->broadcastMessage("{$player->getNameTag()}§fが§cRED§fのコアを破壊している！");
                Server::getInstance()->getLogger()->info("{$player->getNameTag()}§fが§cRED§fのコアを破壊している！");
                $block->getLevel()->broadcastLevelSoundEvent($block->asVector3(), LevelSoundEventPacket::SOUND_RANDOM_ANVIL_USE);
                foreach (Server::getInstance()->getOnlinePlayers() as $player) {
                    LevelSounds::NotePiano($player, 20);
                }
            } elseif (BlueCoreManager::isCore($block)) {
                $event->setCancelled();
                if (BlueTeamManager::isJoined($player)) {
                    return;
                }
                if (RedTeamManager::getListCount() < 1 || BlueTeamManager::getListCount() < 1) {
                    $player->sendMessage('プレイヤーが足りないのでコアを破壊する事が出来ません。');
                    $event->setCancelled();

                    return;
                }
                BlueCoreManager::reduceHP(1, $player);
                GoldAPI::addGold($player, 15);
                LevelAPI::Auto($player, 10);
                Server::getInstance()->broadcastMessage("{$player->getNameTag()}§fが§bBLUE§fのコアを破壊している！");
                Server::getInstance()->getLogger()->info("{$player->getNameTag()}§fが§cRED§fのコアを破壊している！");
                $block->getLevel()->broadcastLevelSoundEvent($block->asVector3(), LevelSoundEventPacket::SOUND_RANDOM_ANVIL_USE);
                foreach (Server::getInstance()->getOnlinePlayers() as $player) {
                    LevelSounds::NotePiano($player, 20);
                }
            }
        }
    }
}
