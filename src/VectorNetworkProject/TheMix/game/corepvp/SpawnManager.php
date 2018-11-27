<?php
/**
 * Copyright (c) 2018 VectorNetworkProject. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/VectorNetworkProject/TheMix
 * Website: https://www.vector-network.tk
 */

namespace VectorNetworkProject\TheMix\game\corepvp;


use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\level\Position;
use pocketmine\Player;
use pocketmine\Server;
use VectorNetworkProject\TheMix\game\corepvp\blue\BlueSpawnManager;
use VectorNetworkProject\TheMix\game\corepvp\blue\BlueTeamManager;
use VectorNetworkProject\TheMix\game\corepvp\red\RedSpawnManager;
use VectorNetworkProject\TheMix\game\corepvp\red\RedTeamManager;
use VectorNetworkProject\TheMix\game\DefaultConfig;
use VectorNetworkProject\TheMix\task\ReSpawnCooldownTask;
use VectorNetworkProject\TheMix\TheMix;

class SpawnManager
{
    public static function PlayerReSpawn(Player $player)
    {
        if (RedTeamManager::isJoined($player)) {
            self::ReSpawnCooldown($player, RedSpawnManager::getRandomPosition());
        } elseif (BlueTeamManager::isJoined($player)) {
            self::ReSpawnCooldown($player, BlueSpawnManager::getRandomPosition());
        } else {
            self::ReSpawnCooldown($player, Server::getInstance()->getDefaultLevel()->getSpawnLocation());
        }
    }

    private static function ReSpawnCooldown(Player $player, Position $position): void
    {
        $player->addTitle('§l§cYOU DIED', 'あなたは死んでしまった！5秒後行動可能になります。', 20, 100, 20);
        $player->teleport(new Position(0, 151, 0, Server::getInstance()->getLevelByName(DefaultConfig::getStageLevelName())));
        $player->setInvisible();
        $player->setGamemode(Player::SPECTATOR);
        $player->setHealth(20);
        $player->setMaxHealth(20);
        $player->setFood(20);
        $player->getInventory()->clearAll();
        $player->removeAllEffects();
        $player->addEffect(new EffectInstance(Effect::getEffect(Effect::NIGHT_VISION), 99999999 * 20, 11, false));
        TheMix::getInstance()->getScheduler()->scheduleDelayedTask(new ReSpawnCooldownTask($player, $position), 100);
    }
}
