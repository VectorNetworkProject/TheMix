<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\game\corepvp;


use pocketmine\Player;
use pocketmine\Server;
use VectorNetworkProject\TheMix\game\corepvp\blue\BlueSpawnManager;
use VectorNetworkProject\TheMix\game\corepvp\blue\BlueTeamManager;
use VectorNetworkProject\TheMix\game\corepvp\red\RedSpawnManager;
use VectorNetworkProject\TheMix\game\corepvp\red\RedTeamManager;
use VectorNetworkProject\TheMix\task\ReSpawnCooldownTask;
use VectorNetworkProject\TheMix\TheMix;

class SpawnManager
{
    public static function PlayerReSpawn(Player $player)
    {
        if (RedTeamManager::isJoined($player)) {
            $player->teleport(RedSpawnManager::getRandomPosition());
            self::ReSpawnCooldown($player);
        } elseif (BlueTeamManager::isJoined($player)) {
            $player->teleport(BlueSpawnManager::getRandomPosition());
            self::ReSpawnCooldown($player);
        } else {
            $player->teleport(Server::getInstance()->getDefaultLevel()->getSpawnLocation());
            self::ReSpawnCooldown($player);
        }
    }

    private static function ReSpawnCooldown(Player $player): void
    {
        $player->addTitle('§l§cYOU DIED', 'あなたは死んでしまった！5秒後行動可能になります。', 20, 100, 20);
        $player->setImmobile();
        $player->setInvisible();
        TheMix::getInstance()->getScheduler()->scheduleDelayedTask(new ReSpawnCooldownTask($player), 100);
    }
}
